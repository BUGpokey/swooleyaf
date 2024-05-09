<?php
/**
 * Tests the conversion of bitwise or tokens to type union tokens.
 *
 * @author    Juliette Reinders Folmer <phpcs_nospam@adviesenzo.nl>
 * @copyright 2020 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\Tokenizer;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;

/**
 * @internal
 * @coversNothing
 */
final class BitwiseOrTest extends AbstractMethodUnitTest
{
    /**
     * Test that non-union type bitwise or tokens are still tokenized as bitwise or.
     *
     * @param string $testMarker The comment which prefaces the target token in the test file.
     *
     * @dataProvider dataBitwiseOr
     * @covers       \PHP_CodeSniffer\Tokenizers\PHP::processAdditional
     */
    public function testBitwiseOr($testMarker)
    {
        $tokens = self::$phpcsFile->getTokens();

        $opener = $this->getTargetToken($testMarker, [T_BITWISE_OR, T_TYPE_UNION]);
        static::assertSame(T_BITWISE_OR, $tokens[$opener]['code']);
        static::assertSame('T_BITWISE_OR', $tokens[$opener]['type']);
    }

    //end testBitwiseOr()

    /**
     * Data provider.
     *
     * @see testBitwiseOr()
     *
     * @return array
     */
    public function dataBitwiseOr()
    {
        return [
            ['/* testBitwiseOr1 */'],
            ['/* testBitwiseOr2 */'],
            ['/* testBitwiseOrPropertyDefaultValue */'],
            ['/* testBitwiseOrParamDefaultValue */'],
            ['/* testBitwiseOr3 */'],
            ['/* testBitwiseOrClosureParamDefault */'],
            ['/* testBitwiseOrArrowParamDefault */'],
            ['/* testBitwiseOrArrowExpression */'],
            ['/* testBitwiseOrInArrayKey */'],
            ['/* testBitwiseOrInArrayValue */'],
            ['/* testBitwiseOrInShortArrayKey */'],
            ['/* testBitwiseOrInShortArrayValue */'],
            ['/* testBitwiseOrTryCatch */'],
            ['/* testBitwiseOrNonArrowFnFunctionCall */'],
            ['/* testLiveCoding */'],
        ];
    }

    //end dataBitwiseOr()

    /**
     * Test that bitwise or tokens when used as part of a union type are tokenized as `T_TYPE_UNION`.
     *
     * @param string $testMarker The comment which prefaces the target token in the test file.
     *
     * @dataProvider dataTypeUnion
     * @covers       \PHP_CodeSniffer\Tokenizers\PHP::processAdditional
     */
    public function testTypeUnion($testMarker)
    {
        $tokens = self::$phpcsFile->getTokens();

        $opener = $this->getTargetToken($testMarker, [T_BITWISE_OR, T_TYPE_UNION]);
        static::assertSame(T_TYPE_UNION, $tokens[$opener]['code']);
        static::assertSame('T_TYPE_UNION', $tokens[$opener]['type']);
    }

    //end testTypeUnion()

    /**
     * Data provider.
     *
     * @see testTypeUnion()
     *
     * @return array
     */
    public function dataTypeUnion()
    {
        return [
            ['/* testTypeUnionPropertySimple */'],
            ['/* testTypeUnionPropertyReverseModifierOrder */'],
            ['/* testTypeUnionPropertyMulti1 */'],
            ['/* testTypeUnionPropertyMulti2 */'],
            ['/* testTypeUnionPropertyMulti3 */'],
            ['/* testTypeUnionParam1 */'],
            ['/* testTypeUnionParam2 */'],
            ['/* testTypeUnionParam3 */'],
            ['/* testTypeUnionReturnType */'],
            ['/* testTypeUnionConstructorPropertyPromotion */'],
            ['/* testTypeUnionAbstractMethodReturnType1 */'],
            ['/* testTypeUnionAbstractMethodReturnType2 */'],
            ['/* testTypeUnionClosureParamIllegalNullable */'],
            ['/* testTypeUnionClosureReturn */'],
            ['/* testTypeUnionArrowParam */'],
            ['/* testTypeUnionArrowReturnType */'],
            ['/* testTypeUnionNonArrowFunctionDeclaration */'],
        ];
    }

    //end dataTypeUnion()
}//end class