<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Information System | CRUD</title>

    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />

    <script type="text/javascript" language="javascript" src="js/jquery-3.4.1.js"></script>

    <script>

        function resetForm() {
            $("#name").val("");
            $("#author").val("");
            $("#genre").val("");
            $("#publisher").val("");
            $("#year").val("");
        }
        var idE = "";
        
        $(document).ready(function() {
            $("#table").load("api/displaybooks.php");
            $("#getID").load("api/getID.php");

            $("#btn-add").click(function(){
                var id = $("#getID").html();
                var name = $("#name").val();
                var author = $("#author").val();
                var genre = $("#genre").val();
                var publisher = $("#publisher").val();
                var year = $("#year").val();
                
                $.post("api/addbook.php", 
                {
                    id: id,
                    name: name,
                    author: author,
                    genre: genre,
                    publisher: publisher,
                    year: year
                },
                function(data, status){
                    alert(data);
                    resetForm();
                    
                    $("#table").load("api/displaybooks.php");
                });
            });

            $("#btn-edit").click(function(){
                var id = idE;
                var name = $("#name").val();
                var author = $("#author").val();
                var genre = $("#genre").val();
                var publisher = $("#publisher").val();
                var year = $("#year").val();
                
                $.post("api/editbook.php", 
                {
                    id: id,
                    name: name,
                    author: author,
                    genre: genre,
                    publisher: publisher,
                    year: year
                },
                function(data, status){
                    alert(data);
                    resetForm();

                    $("#table").load("api/displaybooks.php", function(responseTxt, statusTxt, xhr){
                        $("#table").html(responseTxt);
                    });
                });
            });

            $(document).on("click", ".btn-delete", function(){
                id = $(this).attr("id").split("-")[1];

                var sure = confirm("Click OK to confirm book information permanent delete.");

                if(sure) {
                    $.post("api/deletebook.php", 
                    {
                        id: id
                    },
                    function(data, status) {
                        alert(data);
                        
                        $("#table").load("api/displaybooks.php", function(responseTxt, statusTxt, xhr){
                            $("#table").html(responseTxt);
                        });
                    });
                }
            });

            $("#addbtn").click(function() {
                $("#panel-title").html("Add a member");
                $("#btn-add").css("display", "inline-block");
                $("#btn-edit").css("display", "none");

                var newid = $("#getID").html();
                $("#id").val(newid);
                
                $("#panel").addClass("slide");
            });

            $("#search-item").keyup(function(){
                var item = $("#search-item").val();
                
                $.post("api/searchbook.php", 
                {
                    item: item
                },
                function(data, status) {
                    $("#table").html(data);
                });
            });

            $(document).on("click", ".btn-edit", function(){
                idE = $(this).attr("id").split("-")[1];
                
                $.post("api/click-edit.php", 
                {
                    id: idE
                },
                function(data, status) {
                    var response = JSON.parse(data);
                    
                    var name = response.data[0].name;
                    var author = response.data[0].author;
                    var genre = response.data[0].genre;
                    var publisher = response.data[0].publisher;
                    var year = response.data[0].year;

                    $("#id").val(idE);
                    $("#name").val(name);
                    $("#author").val(author);
                    $("#genre").val(genre);
                    $("#publisher").val(publisher);
                    $("#year").val(year);

                    $("#panel-title").html("Update a book");
                    $("#btn-add").css("display", "none");
                    $("#btn-edit").css("display", "inline-block");

                    $("#panel").addClass("slide");
                });
            });

            $("#exitbtn").click(function() {
                $("#panel").removeClass("slide");
                resetForm();
            });
            
            $("#btn-reset").click(function() {
                resetForm();
            });

        });
        
	</script>
</head>

<body>

    <div class="header">
            BOOK INFORMATION SYSTEM
    </div>
    
    <div class="content">

        <div class='title'>
            <h2>Books</h2>
        </div>
        <hr />
        
        <div class='topbar'>
            <input type="text" id='search-item' placeholder='Search...'/>
            <button id='addbtn'>ADD BOOK</button>
        </div>

        <div class="table-con">
            <table id='table'>

            </table>
        </div>
        
        <a href="#top" id='gototop'>TOP</a>

        <div id="panel">
            <div id='exitbtn'>Close</div>
            <h4 class='panel-title' id='panel-title'>Add a book</h4>
            
            <form>
                <div id='lbl-no'>Book number: </div>
                <input id='id' style='color: #ffd200;' type='number' disabled='true' placeholder='Book number' /><br>
                <input id='name' type='text' placeholder='Book name' /><br>
                <input id='author' type='text' placeholder='Author name' /><br>
                <input id='genre' type='text' placeholder='Genre' /><br>
                <input id='publisher' type='text' placeholder='Publisher' /><br>
                <input id='year' type="text" placeholder='Year published'/>
                <button id='btn-add' type='button' style='display: inline-block;' class='btn btn-outline-success'>ADD BOOK INFO</button>
                <button id='btn-edit' style='display: none;' class='btn btn-outline-success' type="button">UPDATE BOOK INFO</button>

                <div id='getID' style='display: none;'></div>
            </form>
                <button id='btn-reset' style='width: 100px; padding' type="button" class='btn btn-outline-secondary btn-sm'>Reset</button>
        </div>
    </div>
</body>

</html>