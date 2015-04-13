var DataTransformer = {
    toFloat: function(value)
    {
        var patterns = {
            nonDigitAndDot: /[^\d\.]+/g,
            nonDigit: /\D+/g,
            groupLeftWithDotAndRight: /^(\d+\.)(.*)/
        };

        value = value.replace(patterns.nonDigitAndDot, '');

        if (value.match(patterns.groupLeftWithDotAndRight)) {
            match = value.match(patterns.groupLeftWithDotAndRight);
            value = match[1] + match[2].replace(patterns.nonDigit, '');
        }

        return value;
    }
};
