/*
   +----------------------------------------------------------------------+
   | HipHop for PHP                                                       |
   +----------------------------------------------------------------------+
   | Copyright (c) 2010-present Facebook, Inc. (http://www.facebook.com)  |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
*/

#ifndef incl_HPHP_PROGRAM_FUNCTIONS_H_
#define incl_HPHP_PROGRAM_FUNCTIONS_H_

#include "hphp/runtime/base/types.h"
#include "hphp/runtime/vm/treadmill.h"
#include <boost/program_options/parsers.hpp>

namespace HPHP {
///////////////////////////////////////////////////////////////////////////////

struct Transport;
struct Unit;

#if defined(__APPLE__) || defined(_MSC_VER)
extern const void* __hot_start;
extern const void* __hot_end;
#else
extern "C" {
void __attribute__((__weak__)) __hot_start();
void __attribute__((__weak__)) __hot_end();
}
#endif

/**
 * Main entry point of the entire program.
 */
int execute_program(int argc, char **argv);
void execute_command_line_begin(int argc, char **argv, int xhprof);
void execute_command_line_end(int xhprof, bool coverage, const char *program);

void init_command_line_session(int arc, char** argv);
void
init_command_line_globals(int argc, char** argv, char** envp,
                          int xhprof,
                          std::map<std::string, std::string>& serverVariables,
                          std::map<std::string, std::string>& envVariables);
/**
 * Setting up environment variables.
 */
void process_env_variables(Array& variables);

/**
 * Inserting a variable into specified symbol table.
 *
 * "overwrite" parameter is only for cookies:
 * According to rfc2965, more specific paths are listed above the less
 * specific ones. If we encounter a duplicate cookie name, we should
 * skip it, since it is not possible to have the same (plain text)
 * cookie name for the same path and we should not overwrite more
 * specific cookies with the less specific ones.
 */
void register_variable(Array& variables,
                       char* name,
                       const Variant& value,
                       bool overwrite = true);

String canonicalize_path(const String& path, const char* root, int rootLen);

/**
 * Translate hex encode stack into both C++ and PHP frames.
 */
std::string translate_stack(const char *hexencoded,
                            bool with_frame_numbers = true);

time_t start_time();

// Boost 1.54 has a bug where it doesn't handle options with - in them as
// it only gives us the string after the last -
// https://github.com/facebook/hhvm/issues/2864
// This won't fix the problem in 100% of cases (e.g. two options are
// used that both end in the same substring. How do you choose?) But
// that should be very rare.
#if defined(BOOST_VERSION) && BOOST_VERSION <= 105400
std::string get_right_option_name(
  const boost::program_options::basic_parsed_options<char>& opts,
  std::string& wrong_name);
#endif

///////////////////////////////////////////////////////////////////////////////

struct ExecutionContext;

void hphp_process_init();
void hphp_session_init(Treadmill::SessionKind session_kind,
                       Transport* transport = nullptr);

void invoke_prelude_script(
     const char* currentDir,
     const std::string& document,
     const std::string& prelude,
     const char* root = nullptr);
bool hphp_invoke_simple(const std::string& filename, bool warmupOnly);
bool hphp_invoke(ExecutionContext *context,
                 const std::string &cmd,
                 bool func,
                 const Array& funcParams,
                 VRefParam funcRet,
                 const std::string &reqInitFunc,
                 const std::string &reqInitDoc,
                 bool &error,
                 std::string &errorMsg,
                 bool once,
                 bool warmupOnly,
                 bool richErrorMsg,
                 const std::string& prelude);
void hphp_context_exit();

void hphp_thread_init();
void hphp_thread_exit();

void hphp_memory_cleanup();
/*
 * Tear down various internal state at the very end of a session. If transport
 * is provided, various statistics about resources consumed by the request will
 * be logged to ServiceData.
 */
void hphp_session_exit(Transport* transport = nullptr);
void hphp_process_exit() noexcept;
bool is_hphp_session_initialized();
std::string get_systemlib(std::string* hhas = nullptr,
                          const std::string &section = "systemlib",
                          const std::string &filename = "");

// Helper function for stats tracking with exceptions.
void bump_counter_and_rethrow(bool isPsp);


// Log the first time a unit is loaded
void log_loaded_unit(const Unit* u);

///////////////////////////////////////////////////////////////////////////////
}

#endif // incl_HPHP_PROGRAM_FUNCTIONS_H_
