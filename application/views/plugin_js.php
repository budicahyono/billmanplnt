<!-- List of Javascript plugins -->

<!-- DataTables  & Plugins -->
<script src="<?=base_url();?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url();?>plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url();?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url();?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url();?>plugins/jquery-knob/jquery.knob.min.js"></script>
<script> 
    $(function () {
    /* jQueryKnob */

    $('.knob').knob({
        'format' : function (value) {
          return value + '%';
        },
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a   = this.angle(this.cv)  // Angle
            ,
              sa  = this.startAngle          // Previous start angle
            ,
              sat = this.startAngle         // Start angle
            ,
              ea                            // Previous end angle
            ,
              eat = sat + a                 // End angle
            ,
              r   = true

          this.g.lineWidth = this.lineWidth

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3)

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value)
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3)
            this.g.beginPath()
            this.g.strokeStyle = this.previousColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
            this.g.stroke()
          }

          this.g.beginPath()
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
          this.g.stroke()

          this.g.lineWidth = 2
          this.g.beginPath()
          this.g.strokeStyle = this.o.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
          this.g.stroke()

          return false
        }
      }
    })
    /* END JQUERY KNOB */

    

  })

</script>