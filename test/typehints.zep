
/**
 * Type hints
 */

namespace Test;

class TypeHints
{
	protected function getSomething()
	{
		return true;
	}

	public function testNonStrictTypeHint()
	{
		var a, b;

		let a = new self(),
			b = <TypeHints> a;

		return b->getSomething();
	}
}
