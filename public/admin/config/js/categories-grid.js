// (function($) {

//   $(function() {

//     // =========================
//     // INSERT CATEGORY
//     // =========================

//     $("#categoryForm").submit(function(e) {

//       e.preventDefault();

//       let formData = $(this).serialize();

//       $.ajax({

//         type: "POST",

//         url: "/institute_project/admin/php/categories-crud/insert-categories.php",

//         data: formData,

//         success: function(response) {

//           alert("Category Added Successfully");

//           $("#categoryForm")[0].reset();

//         }
//       });
//     });

//   });
//        fields: [
//       {
//         name: "id",
//         type: "number",
//         visible: false
//       },

//       {
//         name: "category_name",
//         type: "text",
//         title: "Category Name"
//       },

//       {
//         name: "slug",
//         type: "text",
//         title: "Slug"
//       },

//       {
//         name: "status",
//         type: "text",
//         title: "Status"
//       },

//       {
//         name: "description",
//         type: "text",
//         title: "Description"
//       },

//       { type: "control" }

//       ]

// })(jQuery);

//     // // =========================
//     // // LOAD TABLE
//     // // =========================

//     // $("#js-grid").jsGrid({

//     //   width: "100%",
//     //   height: "500px",

//     //   editing: true,
//     //   sorting: true,
//     //   paging: true,
//     //   autoload: true,

//     //   pageSize: 10,

//     //   controller: {

//     //     loadData: function() {

//     //       return $.ajax({

//     //         type: "GET",

//     //         url: "../../php/categories-crud/fetch-categories.php",

//     //         dataType: "json"
//     //       });
//     //     },


//     //     updateItem: function(item) {

//     //       return $.ajax({

//     //         type: "POST",

//     //         url: "../../php/categories-crud/update-category.php",

//     //         data: item

//     //       }).done(function() {

//     //         $("#js-grid").jsGrid("loadData");
//     //       });
//     //     },


//     //     deleteItem: function(item) {

//     //       return $.ajax({

//     //         type: "POST",

//     //         url: "../../php/categories-crud/delete-category.php",

//     //         data: item

//     //       }).done(function() {

//     //         $("#js-grid").jsGrid("loadData");
//     //       });
//     //     }
//     //   },
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

                updateItem: function (item) {
                    
                    return $.ajax({
                        type: "POST",
                        url: "ajax/updateCategory.php",
                        data: item,
                        dataType: "json",
                         
                    }).done(function(responce){
                        alert(responce.message());

                        $("#js-Grid").jsGrid("loadData");
                    })
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
            url: "ajax/store-category.php",
            data: $(this).serialize(), // ye form se data ke raha he 
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