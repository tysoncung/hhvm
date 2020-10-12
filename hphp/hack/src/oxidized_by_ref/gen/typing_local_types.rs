// Copyright (c) Facebook, Inc. and its affiliates.
//
// This source code is licensed under the MIT license found in the
// LICENSE file in the "hack" directory of this source tree.
//
// @generated SignedSource<<7526ce3e70c4cebe72ea1350adaa5e56>>
//
// To regenerate this file, run:
//   hphp/hack/src/oxidized_by_ref/regen.sh

use arena_trait::TrivialDrop;
use ocamlrep_derive::FromOcamlRepIn;
use ocamlrep_derive::ToOcamlRep;
use serde::Serialize;

#[allow(unused_imports)]
use crate::*;

pub use typing_defs::*;

pub type ExpressionId = ident::Ident;

#[derive(
    Clone,
    Debug,
    Eq,
    FromOcamlRepIn,
    Hash,
    Ord,
    PartialEq,
    PartialOrd,
    Serialize,
    ToOcamlRep
)]
pub struct Local<'a>(pub &'a Ty<'a>, pub &'a pos::Pos<'a>, pub &'a ExpressionId);
impl<'a> TrivialDrop for Local<'a> {}

pub type TypingLocalTypes<'a> = local_id::map::Map<'a, &'a Local<'a>>;
