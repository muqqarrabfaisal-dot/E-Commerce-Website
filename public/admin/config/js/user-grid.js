(function($) { // ye fnction bante sath hi call hojata he or iske ander $ he mtlb foran jquery start hogai

    $(function (){ // is function ka kam -> Page Ready Hone ka Wait krna 

        $("#user-grid").jsGrid({
            width: "780",
            height: "500px",

            deleting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,

            pageSize: 10,

            controller:{

                loadData: function(){

                    return $.ajax({
                        type: "GET",
                        url: "ajax/users.php",
                        dataType: "json",
                    });
                },
                updateItem: function (item) {
                    return $.ajax({
                        type: "POST",
                        url: "ajax/updateUser.php",
                        data: item,
                        dataType: "json",
 
                    }).done(function (response) {
                        alert(response.message);

                        $("#userForm")[0].reset();
                        $("#user-grid").jsGrid("loadData");
                    });
                },
                deleteItem: function(item){
                    return $.ajax({
                        type: "POST",
                        url: "ajax/deleteUser.php",
                        data: item,
                        dataType: "json",
                    }).done(function (response) {
                       alert(response.message);
                       
                       $("#user-grid").jsGrid('loadData');
                    });
                }

                

            },

            fields: [

                {
                    name: "id",
                    visible: false
                },

                {
                    name: "first_name",
                    title: "First Name",
                    type: "text"
                },

                {
                    name: "last_name",
                    title: "Last Name",
                    type: "text"
                },

                {
                    name: "email",
                    title: "Email",
                    type: "text"
                },

                {
                    name: "phone",
                    title: "Phone",
                    type: "text"
                },

                {
                    type: "control"
                }

            ]



        });

        $("#userForm").submit(function(e) {
            e.preventDefault();

            return $.ajax({
                type: "POST",
                url: "ajax/storeUser.php",
                data: $(this).serialize(), // ye form se data ke raha he
                dataType: "json",

                success: function (response) {
                    if(response.success){
                        alert(response.message);

                        $("#userForm")[0].reset();
                        $("#user-grid").jsGrid("loadData");
                    }else{
                        alert(response.message);
                    }
                }
            });

        });

    });



})(jQuery);