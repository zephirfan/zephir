
#ifdef HAVE_CONFIG_H
#include "../ext_config.h"
#endif

#include <php.h>
#include "../php_ext.h"
#include "../ext.h"

#include <Zend/zend_operators.h>
#include <Zend/zend_exceptions.h>
#include <Zend/zend_interfaces.h>

#include "kernel/main.h"
#include "kernel/memory.h"
#include "kernel/fcall.h"


/**
 * Type hints
 */
ZEPHIR_INIT_CLASS(Test_TypeHints) {

	ZEPHIR_REGISTER_CLASS(Test, TypeHints, test, typehints, test_typehints_method_entry, 0);

	return SUCCESS;

}

PHP_METHOD(Test_TypeHints, getSomething) {


	RETURN_BOOL(1);

}

PHP_METHOD(Test_TypeHints, testNonStrictTypeHint) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *a, *b = NULL;

	ZEPHIR_MM_GROW();

	ZEPHIR_INIT_VAR(a);
	object_init_ex(a, test_typehints_ce);
	if (zephir_has_constructor(a TSRMLS_CC)) {
		ZEPHIR_CALL_METHOD(NULL, a, "__construct", NULL);
		zephir_check_call_status();
	}
	ZEPHIR_CPY_WRT(b, a);
	ZEPHIR_RETURN_CALL_METHOD(b, "getsomething", NULL);
	zephir_check_call_status();
	RETURN_MM();

}

