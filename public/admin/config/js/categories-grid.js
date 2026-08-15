(function ($) { // ye fnction bante sath hi call hojata he or iske ander $ he mtlb foran jquery start hogai

    $(function () { // is function ka kam -> Page Ready Hone ka Wait krna 

        $("#js-grid").jsGrid({
         
            width: "780",
            height: "500px",

            deleting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,

            pageSize: 10,

            controller: {

                loadData: function () {

                    return $.ajax({
                        type: "GET",
                        url: "ajax/categories.php",
                        dataType: "json"
                    });
                    
                },

                updateItem: function(item){

                    return $.ajax({
                        type: "POST",
                        url: "ajax/updateCategory.php",
                        data: item,
                        dataType: "json"

                    }).done(function(response){

                        alert(response.message);

                        $("#js-grid").jsGrid("loadData");

                    });
                },

                deleteItem: function(item){

                    return $.ajax({
                        type: "POST",
                        data:{
                            id: item.id
                        },
                        url:"ajax/deleteCategory.php",
                        dataType: "json",

                        success: function(response){
                            alert(response.message);
                            $("#js-grid").jsGrid("loadData");
                        }

                    });
                }
            },

            fields: [

                {
                    name: "id",
                    type: "number",
                    visible: false
                },

                {
                    name: "category_name",
                    title: "Category Name",
                    type: "text"
                },

                {
                    name: "slug",
                    title: "Slug",
                    type: "text"
                },

                {
                    name: "description",
                    title: "Description",
                    type: "text"
                },

                {
                    name: "status",
                    

                    itemTemplate: function(value){
                        if (value  == 1) {
                            return '<span class="badge badge-success">Active</span>';
                        }else{
                            return '<span class="badge badge-danger">InActive</span>';
                        }
                    },
                    title: "Status",
                    type: "text"
                },
                {
                    type: "control"
                }

            ]

        });

        
    $("#categoryForm").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "ajax/storeCategory.php",
            data: $(this).serialize(), // ye form se data le raha he 
            dataType: "json",

            success: function(response){
                if (response.success) {
                    alert(response.message);

                    $("#categoryForm")[0].reset();
                    $("#js-grid").jsGrid("loadData");
                }else{
                    alert(response.message);
                }
            }
        })
    });


    });

})(jQuery);