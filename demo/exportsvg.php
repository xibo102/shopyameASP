<html>
  <head>

    <!-- this styling is added to the png when it is downloaded -->
    <style>
      circle {fill: red; stroke: blue; stroke-width: 3px;}
      #crowbar-workspace {display: none;}
    </style>
  </head>
  <body>

    <!--
        this is the simple svg that is downloaded. note that it has no styling
    -->
    <svg id="export-me" width="100" height="100">
      <circle r="10" cx="50" cy="50"></circle>
    </svg>
    <button>download png</button>

    <!--
      this is used to download content dynamically from the client side. Note
      that this div is, by default, not visible with the styling above.
    -->
    <div id="crowbar-workspace">
    </div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.10/d3.min.js"></script>
    <!-- <script type="text/javascript" src="svg-crowbar-export.js"></script> -->
    <script>
        d3.select("button").on("click", download_png)
        function download_png () {

          // this is a shitty hack that should probably be embedded in the
          // svg_crowbar function
          var svg_el = d3.select("svg")
              .attr("version", 1.1)
              .attr("xmlns", "http://www.w3.org/2000/svg")
              .node();

          // this is the main thing that does the work
          svg_crowbar(d3.select("#export-me").node(), {
              filename: "export-me.png",
              width: 100,
              height: 100,
              crowbar_el: d3.select("#crowbar-workspace").node(),
          })
        }
    </script>
  </body>
</html>