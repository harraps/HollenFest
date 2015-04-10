/* PLANNING CONTROLLER SCRIPT */


var hollen = {};
hollen.nbStages;

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
    
    hollen.nbStages = nbStages;
    
    hollen.runningOrder = Snap("#runningOrder");
    hollen.addLines("#linegroup", hollen.runningOrder);
    
    var orders = hollen.runningOrder.select("#concerts").selectAll("g");
    for( var i=0; i<orders.length; ++i ){
        hollen.addEvents(orders[i]);
    }
    
    for( var i=0; i<hollen.nbStages; ++i ){
        
        hollen.stages[i] = Snap("#stage-"+i);
        hollen.addLines("#linegroup-"+i, hollen.stages[i]);
        var concerts = hollen.stages[i].select("#concerts-"+i).selectAll("g");
        
        for( var j=0; j<concerts.length; ++j ){
            
            concerts[j].select("rect").hover(
                function(){
                    // if element is hovered
                    this.attr({ stroke: "#fff" });
                },function(){
                    // if element isn't hovered
                    this.attr({ stroke: "#000" });
                }
            );
            concerts[j].click(
                function(){
                    // when object is clicked
                    var copy = this.clone();
                    
                    copy.append(hollen.runningOrder.select("#concerts"));
                    
                    hollen.checkOverlap( copy );
                    // we want to be able to remove an item from the runningOrder without replacing it with an other
                    hollen.addEvents(copy);
                }
            );
            
        }
    }
};

hollen.addEvents = function( element ){
    element.select("rect").hover(
        function(){
            // if element is hovered
            this.attr({ stroke: "#f00" });
        },function(){
            // if element isn't hovered
            this.attr({ stroke: "#000" });
        }
    );
    element.click(
        function(){
            this.remove();
        }
    );
};

// remove all other elements overlaping with this element from the runningOrder
hollen.checkOverlap = function( element ){
    var el_box = element.getBBox();
    var el_beg = el_box.y;
    var el_end = el_box.y+el_box.h;
    
    var orders = hollen.runningOrder.select("#concerts").selectAll("g");
    
    // we iterate in reverse to remove items from the array
    var i = orders.length;
    while( i-- ){
        var box = orders[i].getBBox();
        var beg = box.y;
        var end = box.y+box.h;
        if(
            ( beg > el_beg && end < el_beg ) ||
            ( beg > el_end && end < el_end )
        ){
            orders[i].remove();
        }
    }
};

hollen.addLines = function( tag, svg ){
    
    // we want to have lines to symbolize hours
    // in our planning, 1px = 1min so 60px = 1hour
    var bbox = svg.getBBox();
    
    // for weird reason we have to mutiply by ten to have the right result
    var stage_height = bbox.height * 10;
    
    for( var i=60; i<stage_height; i+=60 ){
        var line = svg.select(tag).line( 0, i, 100, i );
        line.attr({
            stroke: "#141414",
            strokeWidth: 1
        });
    }
};