//Getting value from "ajax.php".

function fill(Value) {

    //Assigning value to "search" div in "search.php" file.

    $('#search').val(Value);

    //Hiding "display" div in "search.php" file.

    $('#display').hide();

}

$(document).ready(function() {

    //On pressing a key on "Search box" in "search.php" file. This function will be called.

    $("#search").keyup(function() {

        //Assigning search box value to javascript variable named as "name".

        var name = $('#search').val();

        //Validating, if "name" is empty.

        if (name == "") {

            //Assigning empty value to "display" div in "search.php" file.

            $("#display").html("");

        }

        //If name is not empty.

        else {

            //AJAX is called.

            $.ajax({

                //AJAX type is "Post".

                type: "POST",

                //Data will be sent to "ajax.php".

                url: "ajax.php",

                //Data, that will be sent to "ajax.php".

                data: {

                    //Assigning value of "name" into "search" variable.

                    search: name

                },

                //If result found, this funtion will be called.

                success: function(html) {

                    //Assigning result to "display" div in "search.php" file.

                    $("#display").html(html).show();

                }

            });

        }

    });


    $('#searchfamily').on('keyup',function(){
        $value=$(this).val();
        if($value)
        {
            $.ajax({
                type : 'POST',
                url : 'ajax.php',
                data:{'searchfamily':$value},
                success:function(data){
                    $('#display-family').html(data);
                }
            });
        }else{
            $('#display-family').html('');
        }
    });

    $('#searchhabit').on('keyup',function(){
        $value=$(this).val();
        if($value)
        {
            $.ajax({
                type : 'POST',
                url : 'ajax.php',
                data:{'searchhabit':$value},
                success:function(data){
                    $('#display-habit').html(data);
                }
            });
        }else{
            $('#display-habit').html('');
        }
    });


    $('#searchdisease').on('keyup',function(){
        $value=$(this).val();
        if($value)
        {
            $.ajax({
                type : 'POST',
                url : 'ajax.php',
                data:{'searchdisease':$value},
                success:function(data){
                    $('#display-disease').html(data);
                }
            });
        }else{
            $('#display-disease').html('');
        }
    });


});

