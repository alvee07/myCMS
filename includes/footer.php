
</div>
</div><!-- main container ends -->

<div class="container">
    <div class="row">
        <footer class="myFooter">
            <p id="footer1p" class="col-sm-12 col-md-6 text-muted">&copy; 2017 Alvee Hassan Akash</p>
            <p id="footer2p" class="col-sm-12 col-md-6 text-muted text-right"><a href="https://www.dal.ca/cs" target="_blank">Faculty of Computer Science</a>, <a href="https://www.dal.ca" target="_blank">Dalhousie University</a></p>
        </footer>
    </div>
</div>

<?php
$conn->close();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>

    $(document).ready(function(){
        $("#use").click(function () {
            $("#try").toggle();
            $("#right").toggleClass("full");
            $("#form-right").toggleClass("half");
        });
    });

    if ($( window ).width() < 700){
        number = $( window ).width();
        //document.getElementById("footer2p").style.display = "none";
        $("#footer2p").removeClass("text-right").addClass("text-center");
        $("#footer1p").addClass("text-center");
        $("#mob-login").css("display", "block");
        //document.getElementById("mob-login").style.display = "block";
    }
    var loggedin = '<?php echo $_SESSION['loggedIn']; ?>';
    if (loggedin){
        $("#mob-login").css("display", "none");
    }

</script>
</body>
</html>