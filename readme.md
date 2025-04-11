# Tokenizer Library Reference

**Version:** 2023.10.18

**Author:** Stefano Braconi

## Introduction

The Tokenizer library provides functions for tokenizing text by separating it based on specified delimiters and optional exclusion patterns. This library is useful for breaking down text into individual tokens, which can be further processed or analyzed.

## Functions

### `separators_sort(&$separators)`

Sort token separators from large to small.

-   **Parameters:**
    -   `$separators` (array) - An array of token separators to be sorted.

### `excluder($tokens, $excludestringin, $excludestringout)`

Searches for a delimiter pattern within an array of tokens and merges the tokens between the specified exclusion patterns.

-   **Parameters:**
    
    -   `$tokens` (array) - An array of tokens to be processed.
    -   `$excludestringin` (string) - The starting delimiter for exclusion.
    -   `$excludestringout` (string) - The ending delimiter for exclusion.
-   **Returns:**
    
    -   An array of tokens with the excluded patterns merged.

### `tokenizer($sourcetext, $separators, $excludestart = null, $excludestop = null, $deleteblank = false)`

Tokenizes a source text based on specified separators and optional exclusion patterns.

-   **Parameters:**
    
    -   `$sourcetext` (string) - The source text to be tokenized.
    -   `$separators` (array) - An array of token separators.
    -   `$excludestart` (string) - (Optional) The starting delimiter for exclusion.
    -   `$excludestop` (string) - (Optional) The ending delimiter for exclusion.
    -   `$deleteblank` (bool) - (Optional) A flag to indicate whether to delete initials and finals blank  in tokens.
-   **Returns:**
    
    -   An array of tokens derived from the source text, processed based on the specified rules.

## Usage

Here's an example of how to use the Tokenizer library:

  
    // Include the Tokenizer library (assuming it's in a separate file).
    include 'tokenizer.php';
    
    // Define the source text and separators.
    $sourcetext = "Hello, world! This is a test string.";
    $separators = [",", " ", "!"];
    
    // Tokenize the text with default settings.
    $tokens = tokenizer($sourcetext, $separators);
    
    // Print the resulting tokens.
    print_r($tokens);

This code will tokenize the source text based on the specified separators and return an array of tokens.
