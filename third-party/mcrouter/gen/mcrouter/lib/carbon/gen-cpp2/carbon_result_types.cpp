/**
 * Autogenerated by Thrift
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
#include "mcrouter/lib/carbon/gen-cpp2/carbon_result_types.h"
#include "mcrouter/lib/carbon/gen-cpp2/carbon_result_types.tcc"

#include <thrift/lib/cpp2/gen/module_types_cpp.h>

#include "mcrouter/lib/carbon/gen-cpp2/carbon_result_data.h"


namespace apache { namespace thrift {

constexpr std::size_t const TEnumTraits<::carbon::Result>::size;
folly::Range<::carbon::Result const*> const TEnumTraits<::carbon::Result>::values = folly::range(::carbon::_ResultEnumDataStorage::values);
folly::Range<folly::StringPiece const*> const TEnumTraits<::carbon::Result>::names = folly::range(::carbon::_ResultEnumDataStorage::names);

char const* TEnumTraits<::carbon::Result>::findName(type value) {
  using factory = ::carbon::_Result_EnumMapFactory;
  static folly::Indestructible<factory::ValuesToNamesMapType> const map{
      factory::makeValuesToNamesMap()};
  auto found = map->find(value);
  return found == map->end() ? nullptr : found->second;
}

bool TEnumTraits<::carbon::Result>::findValue(char const* name, type* out) {
  using factory = ::carbon::_Result_EnumMapFactory;
  static folly::Indestructible<factory::NamesToValuesMapType> const map{
      factory::makeNamesToValuesMap()};
  auto found = map->find(name);
  return found == map->end() ? false : (*out = found->second, true);
}

}} // apache::thrift

namespace carbon {
FOLLY_PUSH_WARNING
FOLLY_GNU_DISABLE_WARNING("-Wdeprecated-declarations")
const _Result_EnumMapFactory::ValuesToNamesMapType _Result_VALUES_TO_NAMES = _Result_EnumMapFactory::makeValuesToNamesMap();
const _Result_EnumMapFactory::NamesToValuesMapType _Result_NAMES_TO_VALUES = _Result_EnumMapFactory::makeNamesToValuesMap();
FOLLY_POP_WARNING

} // carbon

namespace apache {
namespace thrift {
namespace detail {


} // namespace detail
} // namespace thrift
} // namespace apache

