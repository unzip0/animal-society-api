<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\VersionControl\GitMergeConflictSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\LanguageConstructSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\SuperfluousWhitespaceSniff;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Basic\SingleLineEmptyBodyFixer;
use PhpCsFixer\Fixer\Casing\ClassReferenceNameCasingFixer;
use PhpCsFixer\Fixer\Casing\LowercaseStaticReferenceFixer;
use PhpCsFixer\Fixer\Casing\MagicConstantCasingFixer;
use PhpCsFixer\Fixer\Casing\MagicMethodCasingFixer;
use PhpCsFixer\Fixer\Casing\NativeFunctionCasingFixer;
use PhpCsFixer\Fixer\Casing\NativeFunctionTypeDeclarationCasingFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\NoNullPropertyInitializationFixer;
use PhpCsFixer\Fixer\ClassNotation\NoUnneededFinalMethodFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ClassNotation\ProtectedToPrivateFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfStaticAccessorFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleClassElementPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Comment\NoTrailingWhitespaceInCommentFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededControlParenthesesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededCurlyBracesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUselessElseFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\ExplicitIndirectVariableFixer;
use PhpCsFixer\Fixer\LanguageConstruct\FunctionToConstantFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NewWithBracesFixer;
use PhpCsFixer\Fixer\Operator\NoUselessConcatOperatorFixer;
use PhpCsFixer\Fixer\Operator\NoUselessNullsafeOperatorFixer;
use PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer;
use PhpCsFixer\Fixer\Operator\StandardizeIncrementFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\TernaryToElvisOperatorFixer;
use PhpCsFixer\Fixer\Operator\TernaryToNullCoalescingFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocReturnSelfReferenceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSingleLineVarSpacingFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimConsecutiveBlankLineSeparationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarWithoutNameFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitConstructFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertInternalTypeFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitExpectationFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMethodCasingFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitSetUpTearDownVisibilityFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestAnnotationFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Semicolon\SpaceAfterSemicolonFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\ExplicitStringVariableFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesAroundOffsetFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;
use PhpCsFixer\Fixer\Whitespace\StatementIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\TypeDeclarationSpacesFixer;
use PhpCsFixer\Fixer\Whitespace\TypesSpacesFixer;
use Symplify\CodingStandard\Fixer\Annotation\RemovePHPStormAnnotationFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\StandaloneLineInMultilineArrayFixer;
use Symplify\CodingStandard\Fixer\Commenting\ParamReturnAndVarTagMalformsFixer;
use Symplify\CodingStandard\Fixer\Commenting\RemoveUselessDefaultCommentFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\CodingStandard\Fixer\Spacing\StandaloneLinePromotedPropertyFixer;
use Symplify\CodingStandard\Fixer\Strict\BlankLineAfterStrictTypesFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    // Paths
    $ecsConfig->paths([
        __DIR__ . '/ecs.php',
        __DIR__ . '/app',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/config',
        __DIR__ . '/database/seeders',
    ]);

    // Cache
    $ecsConfig->cacheDirectory('.ecs_cache');

    // Parallel process
    $ecsConfig->parallel(300, 16, 20);

    // Skip folders
    $ecsConfig->skip([
        __DIR__ . '/app/Console/Commands/Dev',
    ]);

    // File extensions
    $ecsConfig->fileExtensions(['php']);

    // Identation
    $ecsConfig->indentation(Option::INDENTATION_SPACES);

    // Line ending
    $ecsConfig->lineEnding(PHP_EOL);

    // PSR
    $ecsConfig->sets([
        SetList::PSR_12,
    ]);

    // Clean Code
    $ecsConfig->rules([
        ParamReturnAndVarTagMalformsFixer::class, // Clean Code
        NoUnusedImportsFixer::class, // Imports
        OrderedImportsFixer::class,
        NoEmptyStatementFixer::class,
        ProtectedToPrivateFixer::class, // Architecture
        NoUnneededControlParenthesesFixer::class, // Other
        NoUnneededCurlyBracesFixer::class, // Other
    ]);

    // Arrays
    $ecsConfig->rules([
        NoWhitespaceBeforeCommaInArrayFixer::class,
        ArrayOpenerAndCloserNewlineFixer::class,
        ArrayIndentationFixer::class, // Arrays
        TrimArraySpacesFixer::class, // Arrays
        WhitespaceAfterCommaInArrayFixer::class,
        ArrayListItemNewlineFixer::class,
        StandaloneLineInMultilineArrayFixer::class,
        NoTrailingCommaInSinglelineArrayFixer::class,
    ]);
    $ecsConfig->ruleWithConfiguration(TrailingCommaInMultilineFixer::class, [
        'elements' => [TrailingCommaInMultilineFixer::ELEMENTS_ARRAYS],
    ]);
    $ecsConfig->ruleWithConfiguration(ArraySyntaxFixer::class, [
        'syntax' => 'short',
    ]);

    // Version control / Git
    $ecsConfig->rule(GitMergeConflictSniff::class);

    // Common > Control structures
    $ecsConfig->rules([
        PhpUnitMethodCasingFixer::class,
        FunctionToConstantFixer::class,
        ExplicitStringVariableFixer::class,
        ExplicitIndirectVariableFixer::class,
        NewWithBracesFixer::class,
        StandardizeIncrementFixer::class,
        SelfAccessorFixer::class, // Other
        MagicConstantCasingFixer::class,
        AssignmentInConditionSniff::class,
        NoUselessElseFixer::class, // Architecture
        SingleQuoteFixer::class, // Other
        OrderedClassElementsFixer::class,
    ]);
    $ecsConfig->ruleWithConfiguration(SingleClassElementPerStatementFixer::class, [
        'elements' => ['const', 'property'],
    ]);
    $ecsConfig->ruleWithConfiguration(YodaStyleFixer::class, [
        'equal' => false,
        'identical' => false,
        'less_and_greater' => false,
    ]);

    // Common > Docblock
    $ecsConfig->rules([
        PhpdocLineSpanFixer::class,
        NoTrailingWhitespaceInCommentFixer::class,
        PhpdocTrimConsecutiveBlankLineSeparationFixer::class,
        PhpdocTrimFixer::class,
        NoEmptyPhpdocFixer::class,
        PhpdocNoEmptyReturnFixer::class,
        PhpdocIndentFixer::class,
        PhpdocTypesFixer::class,
        PhpdocReturnSelfReferenceFixer::class,
        PhpdocVarWithoutNameFixer::class,
        RemoveUselessDefaultCommentFixer::class,
    ]);
    $ecsConfig->ruleWithConfiguration(NoSuperfluousPhpdocTagsFixer::class, [
        'remove_inheritdoc' => true,
        'allow_mixed' => true,
    ]);

    // Common > Namespaces
    $ecsConfig->rules([
        NoUnusedImportsFixer::class, // Imports
        OrderedImportsFixer::class,
        SingleBlankLineBeforeNamespaceFixer::class,
    ]);

    // Common > Phpunit
    $ecsConfig->rules([
        PhpUnitTestAnnotationFixer::class,
        PhpUnitSetUpTearDownVisibilityFixer::class,
    ]);

    // Common > Spaces
    $ecsConfig->rules([
        StandaloneLinePromotedPropertyFixer::class,
        BlankLineAfterOpeningTagFixer::class,
        MethodChainingIndentationFixer::class,
        CastSpacesFixer::class, // Spacing
        ClassAttributesSeparationFixer::class,
        SingleTraitInsertPerStatementFixer::class,
        NoBlankLinesAfterClassOpeningFixer::class, // Blank lines
        NoSinglelineWhitespaceBeforeSemicolonsFixer::class,
        PhpdocSingleLineVarSpacingFixer::class,
        NoLeadingNamespaceWhitespaceFixer::class,
        NoSpacesAroundOffsetFixer::class,
        NoWhitespaceInBlankLineFixer::class,
        ReturnTypeDeclarationFixer::class,
        SpaceAfterSemicolonFixer::class,
        TernaryOperatorSpacesFixer::class,
        MethodArgumentSpaceFixer::class,
        LanguageConstructSpacingSniff::class,
    ]);
    $ecsConfig->ruleWithConfiguration(ClassAttributesSeparationFixer::class, [
        'elements' => [
            'const' => 'only_if_meta',
            'property' => 'only_if_meta',
            'method' => 'one',
            'trait_import' => 'only_if_meta',
            'case' => 'only_if_meta',
        ],
    ]);
    $ecsConfig->ruleWithConfiguration(ConcatSpaceFixer::class, [
        'spacing' => 'one',
    ]);
    $ecsConfig->ruleWithConfiguration(SuperfluousWhitespaceSniff::class, [
        'ignoreBlankLines' => false,
    ]);
    $ecsConfig->ruleWithConfiguration(BinaryOperatorSpacesFixer::class, [
        'operators' => [
            '=>' => 'single_space',
            '=' => 'single_space',
        ],
    ]);

    // Common > Strict
    $ecsConfig->rules([
        StrictComparisonFixer::class, // Other
        IsNullFixer::class,
        StrictParamFixer::class,
        DeclareStrictTypesFixer::class, // Other
    ]);

    // Simplify
    $ecsConfig->rules([
        RemovePHPStormAnnotationFixer::class,
    ]);

    $ecsConfig->ruleWithConfiguration(GeneralPhpdocAnnotationRemoveFixer::class, [
        'annotations' => ['author', 'package', 'group', 'covers', 'category'],
    ]);

    // Codely -> https://github.com/CodelyTV/php-coding_style-codely/blob/main/src/coding_style.php
    $ecsConfig->rules([
        // Imports
        FullyQualifiedStrictTypesFixer::class,
        GlobalNamespaceImportFixer::class,
        NoLeadingImportSlashFixer::class,
        // Blank lines
        BlankLineAfterStrictTypesFixer::class,
        // Spacing
        SingleLineEmptyBodyFixer::class,
        TypeDeclarationSpacesFixer::class,
        TypesSpacesFixer::class,
        // Casing
        ClassReferenceNameCasingFixer::class,
        LowercaseStaticReferenceFixer::class,
        MagicMethodCasingFixer::class,
        NativeFunctionCasingFixer::class,
        NativeFunctionTypeDeclarationCasingFixer::class,
        // Architecture
        VisibilityRequiredFixer::class,
        // Operator
        NoUselessConcatOperatorFixer::class,
        NoUselessNullsafeOperatorFixer::class,
        ObjectOperatorWithoutWhitespaceFixer::class,
        TernaryToElvisOperatorFixer::class,
        TernaryToNullCoalescingFixer::class,
        // Testing
        PhpUnitConstructFixer::class,
        PhpUnitDedicateAssertFixer::class,
        PhpUnitDedicateAssertInternalTypeFixer::class,
        PhpUnitExpectationFixer::class,
        // Other
        NoNullPropertyInitializationFixer::class,
        NoUnneededFinalMethodFixer::class,
        SelfStaticAccessorFixer::class,
        StatementIndentationFixer::class,
    ]);

    $ecsConfig->ruleWithConfiguration(LineLengthFixer::class, [
        LineLengthFixer::LINE_LENGTH => 120,
        LineLengthFixer::BREAK_LONG_LINES => true,
        LineLengthFixer::INLINE_SHORT_LINES => false,
    ]);
};
