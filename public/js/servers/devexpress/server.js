$(() => {

  const $filterButton = $('#filter-button');

  const table = $("#server-list").DataTable({
      searching: false,
      bLengthChange: false,
      processing: true,
      paging:false,
      serverSide: true,
      order: [],
      ajax: {
          url: url,
          dataType: 'json',
          cache: false,
          type: 'GET',
          data: function (d) {
              // add dynamic data here
              const data = {
                  // filter by search
                  hdd: $('#hdd').val(),
                  ram: $('input:checkbox[name=ram]:checked').map( function () {
                    return $(this).val();
                  }).get().join(),
                  storage: $('#storage').val(),
                  location: $('#location').val(),
              };

              $.extend(d, data);
          }
      },
      columns: [
          {
              data: "model",
          },
          {
              data: "ram",
          },
          {
              data: "hdd",
          },
          {
              data: "location",
          },
          {
              data: "price",
          }
      ],
      drawCallback: function( nRow, aData, iDisplayIndex ) {
        locations = table.column( 3 ).data().unique();
        $.each(locations, function( i, value ) {
            var o = new Option(value, value);
            $(o).html(value);
            $("#location").append(o);
        });
      },
  });

  $filterButton.on('click', () => table.ajax.reload());

});

$( function() {
    $( "#slider" ).slider({
      value:0,
      range: true,
      min: 0,
      max: 72000,
      step:250,
      slide: function( event, ui ) {
        startValue = parseInt(ui.values[0])>=1000 ? parseInt(ui.values[0]/1000)+"TB" : ui.values[0]+"GB";
        endValue = parseInt(ui.values[1])>=1000 ? parseInt(ui.values[1]/1000)+"TB" : ui.values[1]+"GB";
        $( "#amount" ).val( startValue + " - " + endValue );
        $("#storage").val(startValue + "," + endValue);
      }
    });
    $( "#amount" ).val( $( "#slider" ).slider( "value" ) +"GB" );
  } );