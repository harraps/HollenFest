/* PLANNING CONTROLLER SCRIPT */


var hollen = {};

hollen.stages = {};
hollen.concerts = {};
hollen.runningOrder;
hollen.orders = {};

/**
 * Init the running order
 * @param {string} tag  the id of the div where the running order will be generated
 * @param {map}    data the map of data of the running order
 */
hollen.init = function( nbStages ){
    
    hollen.runningOrder = Snap("#runningOrder");
    hollen.addLines( hollen.runningOrder );
    
    for( var i=0; i<nbStages; ++i ){
        
        hollen.stages[i] = Snap("#"+i);
        hollen.addLines( hollen.stages[i] );
        
        hollen.concerts[i] = hollen.stages[i].selectAll("g");
        
        for( var j=0; j<hollen.concerts[i].length; ++j ){
            
            hollen.concerts[i][j].hover(
                function(){
                    // if element is hovered
                    this.attr({ stroke: "#fff" });
                },function(){
                    // if element isn't hovered
                    this.attr({ stroke: "#000" });
                }
            );
            hollen.concerts[i][j].click(
                function(){
                    // when object is clicked
                    var copy = this.clone();
                    copy.append(hollen.runningOrder);
                    hollen.checkOverlap( copy );
                    // we want to be able to remove an item from the runningOrder without replacing it with an other
                    copy.hover(
                        function(){
                            // if element is hovered
                            this.attr({ stroke: "#f00" });
                        },function(){
                            // if element isn't hovered
                            this.attr({ stroke: "#000" });
                        }
                    );
                    copy.click(
                        function(){
                            hollen.removeFromRunningOrder(this);
                        }
                    );
                    hollen.orders.push(copy);
                }
            );
            
        }
    }
};

// remove all other elements overlaping with this element from the runningOrder
hollen.checkOverlap = function( element ){
    var el_box = element.getBBox();
    var el_beg = el_box.y;
    var el_end = el_box.y+el_box.h;
    
    // we iterate in reverse to remove items from the array
    var i = hollen.orders.length;
    while( --i ){
        
        var box = hollen.orders[i].getBBox();
        var beg = box.y;
        var end = box.y+box.h;
        if(
            ( beg < el_beg && end > el_beg ) ||
            ( beg < el_end && end > el_end )
        ){
            hollen.orders[i].remove();
            hollen.orders[i].splice( i, 1 );
        }
    }
};

hollen.removeFromRunningOrder = function( element ){
    // we want to remove an element so we iterate in reverse
    var i = hollen.orders.length;
    while( --i ){
        
        if( element == hollen.orders[i] ){
            hollen.orders[i].remove();
            hollen.orders[i].splice( i, 1 );
        }
    }
};

hollen.addLines = function( stage ){
    // we want to have lines to symbolize hours
    // in our planning, 1px = 1min so 60px = 1hour
    var bbox = stage.getBBox();
    
    // for weird reason we have to mutiply by ten to have the right result
    var stage_height = bbox.height * 10;
    
    for( var i=60; i<stage_height; i+=60 ){
        var line = stage.line( 0, i, 100, i );
        line.attr({
            stroke: "#000",
            strokeWidth: 1
        });
    }
};