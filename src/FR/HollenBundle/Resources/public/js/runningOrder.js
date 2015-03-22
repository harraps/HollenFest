/* PLANNING CONTROLLER SCRIPT */


var hollen = {};

hollen.tag;
hollen.stages = {};
hollen.shows = {};
hollen.order = {};

/**
 * Init the running order
 * @param {string} tag  the id of the div where the running order will be generated
 * @param {map}    data the map of data of the running order
 */
hollen.init = function( tag, beginDate, data ){
    
    var s = Snap(tag);
    s.attr({ viewBox: "0 0 1000 10000" });
    
    var width = 1000 / Object.keys(data).length;
    var stageCount = 0;
    
    // for each stage from our data map
    for( var i in data ){
        
        // we set the horizontal position of or elements
        var x = width * stageCount;
        
        var scene_name = s.text( x+10, 20, i );
        scene_name.attr({
            fill: "#ddd",
            "font-size": "20px"
        });
        
        // for each show on our stage
        for( var j in data[i] ){
            
            // we set the vertical position based on the begin and end times
            var y = data[i][j][0] + 40;
            var height = data[i][j][1] - data[i][j][0];
            
            var show = s.rect( x, y, width-10, height, 5, 5 );
            show.attr({
                fill: "#131e5d",
            });
            
            var group_name = s.text( x+10, y+30, j );
            group_name.attr({
                fill: "#ddd",
                "font-size": "20px"
            });
            var group_time = s.text( x+10, y+60, [ data[i][j][0], " - ", data[i][j][1] ] );
            group_time.attr({
                fill: "#4485dd",
                "font-size": "15px"
            });
        }
        
        ++stageCount;
    }
    
    
};