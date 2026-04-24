<div class="footer">
    <div class="footer-container">
        <!-- LEFT -->
        <div class="footer-left">
            <h3>Indian Textile Heritage</h3>
            <p>Preserving traditional sarees and weaving culture of India.</p>
        </div>

        <!-- CENTER -->
        <div class="footer-center">
            <h4>Contact</h4>
            <p>Email: bipin@iitd.ac.in</p>
            <p>Phone: +011-26591401</p>
        </div>

        <!-- RIGHT -->
        <div class="footer-right">
            <h4>Follow Us</h4>
            <p>Facebook | Instagram | YouTube</p>
        </div>
    </div>

    <!-- BOTTOM STRIP -->
    <div class="footer-bottom">
        © <?php echo date("Y"); ?> DST &amp T&amp;FE,IITD | All Rights Reserved
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/svg-pan-zoom/3.6.1/svg-pan-zoom.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){
    const svg = document.querySelector("svg");
    if(svg){
        svgPanZoom(svg, {
            zoomEnabled: true,
            controlIconsEnabled: true,
            fit: true,
            center: true,
            minZoom: 1,
            maxZoom: 10
        });
    }
});
</script>
<script>
window.addEventListener("scroll", function() {
    const header = document.querySelector(".header2");
    if (header && window.scrollY > 10) {
        header.classList.add("scrolled");
    } else if (header) {
        header.classList.remove("scrolled");
    }
});
</script>        
</body>
</html>