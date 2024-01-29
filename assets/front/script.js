jQuery(document).ready(function($){
    let $zoom_items = $('.phemrise-zoom-wrapper > .phemrise-zoom').children();
    let $nav_items = $('.phemrise-zoom-wrapper > .phemrise-items-nav').children();
    console.log($nav_items.eq(0));
    for(let i = 0; i < $zoom_items.length; i++)
    {
        $nav_items.eq(i).on("mouseover", function(){
            $zoom_items.eq(i).css('opacity', '1');
            $zoom_items.eq(i).css('transform', 'scale(1)');
        })
        $nav_items.eq(i).on("mouseleave", function(){
            $zoom_items.eq(i).css('opacity', '0');
            $zoom_items.eq(i).css('transform', '');
        })
    }
    // let itemOne = document.querySelector(".item-one")
    // let showItemOne = document.querySelector(".item-01-show")

    
    // let itemTwo = document.querySelector(".item-two")
    // let showItemTwo = document.querySelector(".item-02-show")

    // let itemThree = document.querySelector(".item-three")
    // let showItemThree = document.querySelector(".item-03-show")
    // showItemOne.addEventListener("mouseover", function(){
    //     itemOne.style.opacity = '1';
    //     itemOne.style.transform = 'scale(1)';
    // })
    // showItemOne.addEventListener("mouseleave", function(){
    //     itemOne.style.opacity = '0';
    //     itemOne.style.transform = '';
    // })

    // showItemTwo.addEventListener("mouseover", function(){
    //     itemTwo.style.opacity = '1';
    //     itemTwo.style.transform = 'scale(1)';
    // })
    // showItemTwo.addEventListener("mouseleave", function(){
    //     itemTwo.style.opacity = '0';
    //     itemTwo.style.transform = '';
    // })

    // showItemThree.addEventListener("mouseover", function(){
    //     itemThree.style.opacity = '1';
    //     itemThree.style.transform = 'scale(1)';
    // })
    // showItemThree.addEventListener("mouseleave", function(){
    //     itemThree.style.opacity = '0';
    //     itemThree.style.transform = '';
    // })
})