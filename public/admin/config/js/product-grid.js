(function ($){
    $(function(){

    loadCategories();

        $("#product-grid").jsGrid({
         
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
                        type:"GET",
                        url: "ajax/product.php",
                        dataType: "json"
                    });
                },

                updateItem: function(item){
                    return $.ajax({
                        type: "POST",
                        url: "ajax/updateProduct.php",
                        data: item,
                        dataType: "json"
                    }).done(function(response){
                        if (response.success) {
                            alert(response.message);
                            $("#product-grid").jsGrid("loadData");   
                        }else{
                            alert(response.message);
                        }
                    });
                },
                deleteItem: function(item){
                    return $.ajax({
                        type:"POST",
                        url: "ajax/deleteProduct.php",
                        data: item,
                        dataType: "json",
                    }).done(function(response){
                        if (response.success) {
                            alert(response.message);
                            $("#product-grid").jsGrid("loadData");   
                        }else{
                            alert(response.message);
                        }
                    });
                },

            },
            fields: [

                {
                    name: "id",
                    type: "number",
                    visible: false
                },

                {
                    name: "category_id",
                    type: "number",
                    visible: false
                },
                {
                    name: "image",
                    title: "Image",

                    itemTemplate: function(value, item) {

                        var img = $("<img>")
                            .attr("src", "../uploads/products/" + value)
                            .css({
                                width: "70px",
                                height: "70px",
                                objectFit: "cover",
                                borderRadius: "5px",
                                cursor: "pointer"
                            });

                        // Hidden file input
                        var fileInput = $("<input>")
                            .attr("type", "file")
                            .attr("accept", "image/*")
                            .css("display", "none");

                        // Image click
                        img.on("click", function() {

                            console.log("Image Clicked");
                            console.log("product ID", item.id);
                            console.log("Current Image", value);

                            fileInput.trigger("click");
                        });

                        // New image selected
                        fileInput.on("change", function() {

                            var file = this.files[0];

                            if (!file) {
                                return;
                            }

                            console.log("New Image", file.name);

                            var formData = new FormData();

                            formData.append("id", item.id);
                            formData.append("image", file);

                            $.ajax({
                                type: "POST",
                                url: "ajax/updateProductImage.php",
                                data: formData,
                                contentType: false,
                                processData: false,
                                dataType: "json",

                                success: function(response) {

                                    console.log("Server Response:", response);

                                    $("#product-grid").jsGrid("loadData");

                                },

                                error: function(xhr) {

                                    console.log("AJAX Error:", xhr.responseText);

                                }
                            });

                        });

                        return $("<div>")
                            .append(img)
                            .append(fileInput);
                    },

                    sorting: false
                },
                {
                    name: "category_name",
                    title: "Category",
                    type: "text"
                },

                {
                    name: "product_name",
                    title: "Product Name",
                    type: "text"
                },
                
                {
                    name: "description",
                    title: "Description",
                    type: "text"
                },

                {
                    name: "price",
                    title: "Price",
                    type: "number"
                },
                
                {
                    name: "quantity",
                    title: "Quantity",
                    type: "number"
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

    $("#productForm").submit(function(e){
        e.preventDefault();

        return $.ajax({
            type:"POST",
            url: "ajax/storeProduct.php",
            data: new FormData(this),  
            contentType: false,
            processData: false,
           // dataType: "json",

            success: function(response){
                if (response.success) {
                    alert(response.message);

                    $("#productForm")[0].reset();
                    $("#product-grid").jsGrid("loadData");
                }else{
                    alert(response.message);
                }
            }
        });    
    });

    function loadCategories(){
        return $.ajax({
            type: "GET",
            url: "ajax/productgetcategories.php",
            dataType: "json",

            success: function(response){

                console.log(response);

                $("#category_id").empty();
                $("#category_id").append(
                    '<option value="">Select Category</option>'
                );

                $.each(response,function(index, item){// each aik aik object ko uthata he 
                    $("#category_id").append(// append mtlb iske ander Html Add karo 
                        '<option value="' + item.id + '">' +
                        item.category_name +
                        '</option>'
                    );
                });
            }
        });
    }

    
    });
})(jQuery);