(*
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the "hack" directory of this source tree.
 *
 *)

open Hh_prelude
open Reordered_argument_collections

(** A [deferment] is a file which contains a decl that we need to fetch before
    we continue with our scheduled typechecking work. The handler of exception [Defer (d.php, "\\D")]
    will typically call [add_deferment ~d:(d.php, "\\D")]. *)
type deferment = Relative_path.t * string [@@deriving show, ord]

(** We raise [Defer (d.php, "\\D")] if we're typechecking some file a.php, and find
    we need to fetch some class D from d.php, but the typechecking of a.php had already
    needed just too many other decls. *)
exception Defer of deferment

module Deferment = struct
  type t = deferment

  let compare = compare_deferment

  let to_string = show_deferment
end

module Deferment_set = Reordered_argument_set (Caml.Set.Make (Deferment))

type deferments_t = Deferment_set.t

type state = {
  enabled: bool;
  deferments: deferments_t;
  counter: int;
      (** Counter for decls needing to be computed out of the ASTs. *)
  threshold_opt: int option;
      (** If [counter] goes beyond this threshold, we raise and defer the typechecking. *)
}

let state : state ref =
  ref
    {
      enabled = true;
      deferments = Deferment_set.empty;
      counter = 0;
      threshold_opt = None;
    }

let reset ~(enable : bool) ~(threshold_opt : int option) : unit =
  state :=
    {
      enabled = enable;
      counter = 0;
      deferments = Deferment_set.empty;
      threshold_opt;
    }

(** Increment the counter of decls needing computing. *)
let increment_counter () : unit =
  if !state.enabled then state := { !state with counter = !state.counter + 1 }

(** Call [raise_if_should_defer ~deferment:("d.php", "\\D")] if you're typechecking some file a.php,
    and discover that you need to fetch yet another class "\\D" from file d.php.
    This will raise if the counter for computed decls is over the set up threshold. *)
let raise_if_should_defer ~(deferment : deferment) : unit =
  match (!state.enabled, !state.threshold_opt) with
  | (true, Some threshold) when !state.counter >= threshold ->
    raise (Defer deferment)
  | _ -> ()

(** [add_deferment ~d:("d.php", "\\D")] is called for a file "d.php" which contains a decl "\\D"
    that we need before we can proceed with our normal typechecking work. *)
let add_deferment ~(d : deferment) : unit =
  state := { !state with deferments = Deferment_set.add !state.deferments d }

(** "deferments" are files which contain decls that we need to fetch
    before we can get on with our regular typechecking work. *)
let get_deferments () : deferment list =
  !state.deferments |> Deferment_set.elements
