(function ($){

    $(function(){

        const param = new URLSearchParams(window.location.search);

        const orderId = param.get("id");

        $.ajax({
            type: "GET",
            url: "ajax/order-detail.php",
            data:{
                id : orderId
            },
            dataType: "json",
            
            success: function (response) {

                console.log(response);

                const order = response.order;

                $("#order-details").html(`
                    <table class="table table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <td>${order.id}</td>
                        </tr>

                        <tr>
                            <th>First Name</th>
                            <td>${order.first_name}</td>
                        </tr>

                        <tr>
                            <th>Last Name</th>
                            <td>${order.last_name}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>${order.email}</td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td>${order.phone}</td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td>${order.address}</td>
                        </tr>

                        <tr>
                            <th>City</th>
                            <td>${order.city}</td>
                        </tr>

                        <tr>
                            <th>Country</th>
                            <td>${order.country}</td>
                        </tr>

                        <tr>
                            <th>Zip Code</th>
                            <td>${order.zip_code}</td>
                        </tr>

                        <tr>
                            <th>Payment Method</th>
                            <td>${order.payment_method}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>${order.status}</td>
                        </tr>

                        <tr>
                            <th>Total Amount</th>
                            <td>${order.total_amount}</td>
                        </tr>

                        <tr>
                            <th>Order Notes</th>
                            <td>${order.order_notes}</td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>${order.created_at}</td>
                        </tr>
                    </table>
                `);

                const items = response.items;

                    let itemsHtml = `
                        <h4 class="mt-4 mb-3">Order Items</h4>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                    `;

                    items.forEach(function(item) {

                        itemsHtml += `
                            <tr>
                                <td>${item.product_name}</td>
                                <td>${item.price}</td>
                                <td>${item.quantity}</td>
                                <td>${item.subtotal}</td>
                            </tr>
                        `;

                    });

                    itemsHtml += `</tbody></table>`;

                    $("#order-details").append(itemsHtml);
            }
        });


    });



})(jQuery);