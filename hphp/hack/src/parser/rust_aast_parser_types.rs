// Copyright (c) Facebook, Inc. and its affiliates.
//
// This source code is licensed under the MIT license found in the
// LICENSE file in the "hack" directory of this source tree.

use ocamlrep_derive::OcamlRep;

use oxidized::{aast, file_info, parser_options, pos, scoured_comments};
use parser_core_types::syntax_error::SyntaxError;

#[derive(Clone, Debug, OcamlRep)]
pub struct Env {
    pub is_hh_file: bool,
    pub codegen: bool,
    pub php5_compat_mode: bool,
    pub elaborate_namespaces: bool,
    pub include_line_comments: bool,
    pub keep_errors: bool,
    pub quick_mode: bool,
    pub show_all_errors: bool,
    pub lower_coroutines: bool,
    pub fail_open: bool,
    pub parser_options: parser_options::ParserOptions,
    pub hacksperimental: bool,
}

#[derive(Clone, Debug, OcamlRep)]
pub struct Result {
    pub file_mode: file_info::Mode,
    pub scoured_comments: scoured_comments::ScouredComments,
    pub aast: std::result::Result<aast::Program<pos::Pos, (), (), ()>, String>,
    pub lowpri_errors: Vec<(pos::Pos, String)>,
    pub errors: Vec<SyntaxError>,
}