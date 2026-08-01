(function($) {
  'use strict';
  $(function() {

    if ($("#js-grid").length) {
      $("#js-grid").jsGrid({
        height: "500px",
        width: "100%",
        filtering: true,
        editing: true,
        inserting: true,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,
        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete the client?",

        controller: {

        loadData: function(filter) {

            return $.ajax({
                type: "GET",
                url: "php/fetch-data.php",
                dataType: "json"
            });
        },

        deleteItem: function(item) {

            return $.ajax({
                type: "POST",
                url: "php/delete-data.php",
                data: item
            });
          },
        
        insertItem: function(item) {
          return $.ajax({
            type: "POST",
            url : "php/insert-data.php",
            data: item
          }).done(function(){
            $("#js-grid").jsGrid(loadData);
          });
        },

        updateItem: function(item){
          return $.ajax({
            type: "POST",
            url: "php/update-data.php",
            data: item
          }).done(function(){
            $("#js-grid").jsGrid(loadData);
          });
        }
      },

        fields: [
          { name: "id", type: "number", title: "Id", visible: false},
          { name: "fullname", type: "text", title: "Name", width: 150 },
          { name: "age", type: "number", title: "Age", width: 50 },
          { name: "email", type: "text", title: "Address", width: 150 },
          { name: "country", type: "text", title: "Country", width: 100 },
          { type: "control" }
        ]
      });
    }
  });
})(jQuery);