<svg id="pane" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 450 450" preserveAspectRatio="xMidYMid meet" onload="init(60,false)">
    <script type="text/javascript">
        <![CDATA[
        Math.rnd=function(von, bis) {
            const min= Math.min(von, bis);
            return Math.random() * (Math.max(von, bis) - min) + min;
        }

        function spline(x, y, minR, maxR) {
            var
                    alpha = Math.rnd (0, 2 * Math.PI)
                    , mtx= Math.rnd (minR, maxR)
                    , mty= Math.rnd (minR, maxR / 1.4)
                    , tx= mtx * Math.sin (alpha)
                    , ty= mty * Math.cos (alpha)
                    , sx= (mtx * Math.rnd (0.1, 0.9)) * Math.sin (alpha)
                    , sy= mty * Math.cos (alpha)
                    , target = {x: Math.round(tx + x), y: Math.round(ty + (y * 1.1))}
                    , spline = {x: Math.round(sx + x), y: Math.round(sy + (y * Math.rnd (0.5, 0.9)))}
                    , path = 'M' + x + ' ' + y + 'Q' + spline.x + ' ' + spline.y + ',' + target.x + ' ' + target.y
                    , rotate = 'auto' + ((target.x > x) ? '-reverse' : '')
                    ;
            return {path: path, rotate: rotate};
        }

        function init(elements, visibility) {
            const
                    BEGIN= 'begin'
                    , PATH= 'path'
                    , ROTATE= 'rotate'
                    , DUR= 'dur'
                    , D= 'd'
                    , STYLE= 'style'
                    , ID= 'id'
                    ;
            var
                    svg= document.getElementById ('pane')
                    , c= svg.getElementById ('pfad')
                    , d= svg.getElementById ('objekt')
                    ;

            for (var i= 1; i <= elements; i++) {
                var
                        t= Math.rnd (2, 10)
                        , s= spline (225, 225, 25, 220)
                        , cln= c.cloneNode (true)
                        , dln= d.cloneNode (true)
                        ;

                cln.setAttribute (ID, 'pfad' + i);
                cln.setAttribute (STYLE, 'visibility:' + (visibility ? 'visible' : 'hidden'));
                cln.setAttribute (D, s.path);
                svg.appendChild (cln);

                dln.setAttribute (ID, 'objekt' + i);
                dln.childNodes[1].setAttribute (ID, 'a1_' + i); // motion
                dln.childNodes[1].setAttribute (PATH, s.path); // motion
                dln.childNodes[1].setAttribute (ROTATE, s.rotate); // motion
                dln.childNodes[1].setAttribute (DUR, t); // motion
                dln.childNodes[3].setAttribute (DUR, t); // fill
                dln.childNodes[5].setAttribute (DUR, t); // opacity
                dln.childNodes[7].setAttribute (DUR, t); // scale
                svg.appendChild (dln);
            }
            svg.removeChild (c);
            svg.removeChild (d);
            document.getElementById ('a1_1').setAttribute (BEGIN, '0s'); // Begin when all is set and done
        }

        ]]>
    </script>
    <defs>
        <g id="flower">
            <defs>
                <style>
                    circle {fill:yellow;stroke:lightgreen;sroke-width:0.5}
                    ellipse {fill:rose;stroke:pink;sroke-width:0.5}
                </style>
                <g id="blatt">
                    <ellipse cx="0" cy="0" rx="7" ry="10" transform="translate (0,10)"/>
                </g>
            </defs>
            <use xlink:href="#blatt"/>
            <use xlink:href="#blatt" transform="rotate(72)"/>
            <use xlink:href="#blatt" transform="rotate(144)"/>
            <use xlink:href="#blatt" transform="rotate(216)"/>
            <use xlink:href="#blatt" transform="rotate(288)"/>
            <circle cx="0" cy="0" r="3"/>
        </g>
    </defs>
    <style>
        path {stroke:black;stroke-width:0.1;stroke-linecap:round;fill:none}
        use {will-change:opacity}
    </style>
    <path id="pfad" d=""/>
    <use id="objekt" width="40" height="40" xlink:href="#flower">
        <animateMotion begin="a1_1.begin" repeatCount="indefinite" fill="remove"/>
        <animate attributeName="fill" attributeType="CSS" values="blue;lightblue;yellow" repeatCount="indefinite" fill="remove"/>
        <animate attributeName="opacity" values="0.1;1;0.6;" repeatCount="indefinite" fill="remove"/>
        <animateTransform attributeName="transform" type="scale" from="1" to="0" repeatCount="indefinite" fill="remove"/>
    </use>
</svg>