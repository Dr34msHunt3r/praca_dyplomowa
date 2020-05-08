$(document).ready(function(){
    
    $(".anchors").click(function(){
        var id = $(this).attr('id');
        console.log(id);
        $.post("/io/templates/dispbook.php",{
            category: id
        }, function(data, status){
            $(".gallery").html(data);
        });
        
    });
    $("body").on("click", ".book_box",(function(){
        var b_id = $(this).attr('id');
        console.log(b_id);
        $.post("/io/templates/dispbook.php",{
            book_id: b_id
        }, function(data, status){
            $(".gallery").html(data);
        });
    
    }));
    $("body").on("click", ".cancel_btn",(function(){
        var id = $(this).attr('id');
        console.log(id);
        $.post("/io/templates/dispbasket.php",{
            button_id: id
        }, function(data, status){
            $(".gallery").html(data);
        });
    
    }));
    $("body").on("click", "input[name=rentbook]",(function(){
        var user_id = $(this).attr('id');
        var book_id = $(this).attr('class');
        console.log(user_id);
        console.log(book_id);
        $.post("/io/templates/dispusers.php",{
            rentuserid: user_id,
            rentbookid: book_id
        }, function(data, status){
            $(".everything").html(data);
        });
    
    }));
    $("body").on("click", "input[name=cancelbook]",(function(){
        var user_id = $(this).attr('id');
        var book_id = $(this).attr('class');
        console.log(user_id);
        console.log(book_id);
        $.post("/io/templates/dispusers.php",{
            bookuserid: user_id,
            bookbookid: book_id
        }, function(data, status){
            $(".everything").html(data);
        });
    
    }));
    $("body").on("click", "input[name=getback]",(function(){
        var user_id = $(this).attr('id');
        var book_id = $(this).attr('class');
        console.log(user_id);
        console.log(book_id);
        $.post("/io/templates/dispusers.php",{
            getbackuserid: user_id,
            getbackbookid: book_id
        }, function(data, status){
            $(".everything").html(data);
        });
    
    }));
    $("body").on("click", "input[name=delete_user]",(function(){
        var user_id = $(this).attr('id');
        console.log(user_id);
        $.post("/io/templates/dispusers.php",{
            deleteuserid: user_id
        }, function(data, status){
            $(".everything").html(data);
        });
    
    }));
    

});