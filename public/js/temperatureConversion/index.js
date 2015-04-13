jQuery(function() {
    form.loadOnlyFloatInput();
    form.loadOnSubmit();
    form.loadChangeConversionType();
});

var form = {
    loadOnlyFloatInput: function()
    {
        $('#celsius, #fahrenheit').keyup(function() {
            var self = $(this);

            self.val(
                DataTransformer.toFloat(
                    self.val()
                )
            );
        });
    },

    loadOnSubmit: function()
    {
        $('form#conversion').submit(function(e) {
            e.preventDefault();

            var baseConversionType = form.getBaseConversionType(),
                data = {
                    'celsius': $(this).find('#celsius').val(),
                    'fahrenheit': $(this).find('#fahrenheit').val(),
                    'conversionType': $(this).find('#' + baseConversionType + 'BaseType').val()
                },
                baseConversionTypeInput = $('#' + baseConversionType);

            if ('' !== data[baseConversionType]) {
                $.ajax({
                    method: 'POST',
                    url: '/index.php',
                    dataType: 'json',
                    data: {
                        /**
                         * @todo Api\Internal com requisição de Controller dinâmica.
                         */
                        'controller': 'TemperatureConversion\\Controller\\TemperatureConversionController',
                        'data': data
                    },
                    success: function(json) {
                        if (json.error === '') {
                            var resultElementId = form.getResultElementId(data);

                            $(resultElementId).val(json.response);
                        }
                    }
                });
                baseConversionTypeInput.removeClass('error');
            } else {
                baseConversionTypeInput.addClass('error');
            }

            return false;
        });
    },

    getResultElementId: function(data)
    {
        return data.conversionType === 'celsiusToFahrenheit'
            ? '#fahrenheit'
            : '#celsius';
    },

    loadChangeConversionType: function()
    {
        $('#changeConversionType').click(function(e) {
            e.preventDefault();

            var inputs = $('form#conversion input[type="text"]'),
                inputAttributesName = ['id', 'name', 'placeholder'],
                conversionType = $('.conversionType');

            var backupElementAttributes = form.getElementAttributes(
                inputs[0],
                inputAttributesName
            );

            // Transferindo os atributos do segundo
            // elemento para o primeiro.
            form.setElementAttributes(
                inputs[0],
                form.getElementAttributes(
                    inputs[1],
                    inputAttributesName
                )
            );

            // Transferindo os atributos do primeiro
            // elemento para o segundo.
            form.setElementAttributes(
                inputs[1],
                backupElementAttributes
            );

            var baseType = inputs[0].id;
            conversionType.attr('enabled', false);
            $('#' + baseType + 'BaseType').attr('enabled', true);
        });
    },

    getElementAttributes: function(element, arrayAttributesName)
    {
        var attributesBag = {};
        for (var attr of arrayAttributesName) {
            attributesBag[attr] = element[attr]
        }
        return attributesBag;
    },

    setElementAttributes: function(element, objectAttributes)
    {
        for (var attributeName in objectAttributes) {
            element[attributeName] = objectAttributes[attributeName];
        }
    },

    getBaseConversionType: function()
    {
        return $('form#conversion input[type="text"]')[0].id;
    }
};
