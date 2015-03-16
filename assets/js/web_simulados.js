(function ($) {

    //Quick AJAX to get all categories present in the database
    var categories = $.ajax('http://localhost/ajax/get_categories/', {
        'async': false
    }).responseText;

    //Selected categories by user
    var categoriesSelected = new Array();

    //Return JSON Objects array of sub categories
    function getSubCategoriesFrom(category, level) {
        var categoryJson = jQuery.parseJSON(categories);
        var foundCategories = new Array();
        for (var i = 0; i < categoryJson.length; i++) {
            if (parseInt(categoryJson[i].sub_category_level) == level && categoryJson[i].sub_category_from == category) {
                foundCategories[foundCategories.length] = categoryJson[i]
            }
        }
        return foundCategories;
    }

    //Return String of category name
    function getCategoryName(id) {
        var categoryJson = jQuery.parseJSON(categories);
        for (var i = 0; i < categoryJson.length; i++) {
            if (parseInt(categoryJson[i].id) == id) {
                return categoryJson[i].category_name;
            }
        }
    }

    //Plugin to handle sub-categories on a <select> tag
    $.fn.categorySelector = function (options) {
        var settings = $.extend({
            addButtonId: '#categorySelectorAddButton',
            submitButtonId: '#categorySelectorSubmitButton',
            listId: '#categorySelectorList',
            selectedCategoryInputId: '#categorySelectorSelectedInput',
            numPerCategoryInputId: '#categorySelectorNumPerCategoryInput',
            numPerCategoryValue: '#categorySelectorNumPerCategoryValue',
            formId: '#categorySelectorForm'
        }, options);

        //Bind change listener to first <select>
        this.bind("change", function () {
            var subCategoryLevel = parseInt($(this).attr('data-level')) + 1;
            var categoryId = parseInt($(this).val());
            var subCategories = getSubCategoriesFrom(categoryId, subCategoryLevel);
            var parentElem = $(this).parent();

            console.log('Found ' + subCategories.length + ' on category ' + categoryId + ' level ' + subCategoryLevel);

            //Remove <select> from sub-categories
            parentElem.find('#subCategorySelector[data-level="' + subCategoryLevel + '"]').remove();

            if (subCategories.length != 0) {
                //Prepare new <select> to be appended
                var selectToAppend = $('<select></select>')
                    .attr('data-level', subCategoryLevel)
                    .attr('id', 'subCategorySelector')
                    .addClass('form-control');


                //Append all categories inside new <select> tag
                selectToAppend.append('<option disabled selected value="0">Selecione sub-categoria...</option>');
                for (var i = 0; i < subCategories.length; i++) {
                    selectToAppend.append($('<option>' + subCategories[i].category_name + '</option>').attr('value', subCategories[i].id))
                }

                parentElem.append(selectToAppend);
                selectToAppend.categorySelector();
            }
        });

        $(settings.addButtonId).bind("click", function () {
            var biggestLevel = -1;
            var biggestLevelId = -1;
            var path = new Array();
            $(this).parent().find('select').each(function () {
                var level = parseInt($(this).attr('data-level'));
                var val = $(this).val();

                if (biggestLevel < level && val != null) {
                    biggestLevel = level;
                    biggestLevelId = val;
                    path[path.length] = val;
                }
            });
            if (biggestLevelId != -1 && categoriesSelected.indexOf(biggestLevelId) == -1) {
                categoriesSelected[categoriesSelected.length] = biggestLevelId;
                var categoryPath = '';
                for (var i = 0; i < path.length; i++) {
                    categoryPath += getCategoryName(path[i]);
                    if (i < path.length - 1) {
                        categoryPath += " > ";
                    }
                }
                $(settings.listId).append('<li>' + categoryPath + '</li>');
                $(this).parent().find('select[data-level!="0"]').remove();
                $(this).parent().find('select[data-level="0"]')[0].selectedIndex = 0;
            }
        });

        $(settings.formId).bind("submit", function () {
            $(this).attr('action', $(this).attr('data-baseurl') + '/' + categoriesSelected.join('-') + '/' + $(settings.numPerCategoryValue).val());

            console.log(categoriesSelected.join(', '));
            console.log($(settings.numPerCategoryValue).val());
            console.log($(this).attr('data-baseurl') + '/' + categoriesSelected.join('-') + '/' + $(settings.numPerCategoryValue).val());

        });
    };

})(jQuery);


(function ($) {
    $('.spinner .btn:first-of-type').on('click', function () {
        $('.spinner input').val(parseInt($('.spinner input').val(), 10) + 1);
    });
    $('.spinner .btn:last-of-type').on('click', function () {
        $('.spinner input').val(parseInt($('.spinner input').val(), 10) - 1);
    });
})(jQuery);


$("#categorySelector").categorySelector();