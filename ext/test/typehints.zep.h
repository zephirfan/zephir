
extern zend_class_entry *test_typehints_ce;

ZEPHIR_INIT_CLASS(Test_TypeHints);

PHP_METHOD(Test_TypeHints, getSomething);
PHP_METHOD(Test_TypeHints, testNonStrictTypeHint);

ZEPHIR_INIT_FUNCS(test_typehints_method_entry) {
	PHP_ME(Test_TypeHints, getSomething, NULL, ZEND_ACC_PROTECTED)
	PHP_ME(Test_TypeHints, testNonStrictTypeHint, NULL, ZEND_ACC_PUBLIC)
  PHP_FE_END
};
