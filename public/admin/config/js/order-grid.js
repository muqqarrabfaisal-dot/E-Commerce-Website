(function ($) {

    $(function () {

        $("#order-grid").jsGrid({

            width: "100%",

            height: "600px",

            editing: true,

            deleting: false,

            sorting: true,

            paging: true,

            autoload: true,

            pageSize: 10,

            controller: {

                loadData: function () {

                    return $.ajax({
                        type: "GET",
                        url: "ajax/order.php",
                        dataType: "json"
                    });

                },
                updateItem: function(item){
                    return $.ajax({
                        type: "POST",
                        url: "ajax/order.php",
                        data: {
                            order_id: item.id,
                            status: item.status
                        },
                        dataType: "json"
                    }).then(function(response) {

                        if (response.status) {
                            return item;
                        }

                        return $.Deferred().reject().promise();

                    });
                }
                

            },

            fields: [

                {
                    name: "id",
                    title: "Order ID",
                    type: "number",
                    width: 60
                },

                {
                    name: "first_name",
                    title: "First Name",
                    type: "text",
                    width: 120
                },

                {
                    name: "last_name",
                    title: "Last Name",
                    type: "text",
                    width: 120
                },

                {
                    name: "email",
                    title: "Email",
                    type: "text",
                    width: 200
                },

                {
                    name: "phone",
                    title: "Phone",
                    type: "text",
                    width: 130
                },

                {
                    name: "payment_method",
                    title: "Payment",
                    type: "text",
                    width: 100
                },

                {
                    name: "total_amount",
                    title: "Total",
                    type: "number",
                    width: 100
                },

                {
                    name: "status",
                    title: "Status",
                    type: "select",
                    width: 100,

                    items:[
                        {Name:"pending", Value:"pending"},
                        {Name:"processing", Value:"processing"},
                        {Name:"shiped", Value:"shiped"},
                        {Name:"Deliverd", Value:"Deliverd"},
                        {Name:"Cancelled", Value:"Cancelled"}
                    ],

                    valueField: "Value",
                    textField: "Name"
                },

                {
                    name: "created_at",
                    title: "Order Date",
                    type: "text",
                    width: 160
                },
                {
                  type: "control"  
                },
                {
                    title: "Action",
                    width: 100,

                    itemTemplate: function(value,item){

                        var btn = $("<button>")
                        .text("View")
                        .addClass("btn btn-primary btn-sm");

                    button.on("click",function(){
                        window.location.href = "order-detail.php?id=" + item.id;
                    });

                    return button;
                    }
                }
            ]

        });

    });

})(jQuery);