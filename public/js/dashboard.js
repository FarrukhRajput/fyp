
$(document).ready( () =>{
    var navDropdown  = $(".nav-dropdown");
    var dropdownStatus = false;

    // SIDENAV OPEN & CLOSE 
    $(".menuBtn").click( () => {
        $(".dashboard-brand , .dashboard-sidebar").toggleClass("mini-nav");
        $(".brand-abbr , .brand-title " ).toggleClass("d-none");
        $(".nav-item , .nav-dropdown").children("span , i.arrow").toggleClass("d-none");
        $(".dashboard-content-area").toggleClass("dashboard-content-padding")
            if(dropdownStatus){
                $(".nav-sublist ").each( (_ , item) => {
                    if( !item.classList.contains("d-none")){
                        item.classList.add("d-none");
                        dropdownStatus = false;
                    }
                } )
            }

            navDropdown.each( ( _ , item) => {
                item.children[2].classList.remove("rotate-arrow");
            });
        
     });

    // // DROPDOWN OPEN & CLOSE
    navDropdown.each( ( _ , dropdown) => {
        dropdown.addEventListener("click" , (e) => {
            e.preventDefault();
            let x = $(".dashboard-sidebar");
            if(!x.hasClass("mini-nav")){
                if(dropdown.nextElementSibling.classList.contains("d-none")){

                    let  y = $(".nav-sublist");

                    y.each( ( _ , item) => {
                        item.classList.add("d-none");
                        item.previousElementSibling.children[2].classList.remove("rotate-arrow");
                    });
                    

                    dropdown.nextElementSibling.classList.remove("d-none");
                    dropdownStatus = true;
                    dropdown.children[2].classList.add("rotate-arrow")
                }
                else{
                    dropdown.nextElementSibling.classList.add("d-none");
                    dropdown.children[2].classList.remove("rotate-arrow")
                }
            }
        });
    });
});

    // USER ICON PROFILE
    $(".user-icon").click( () => {
        $(".drop-down").toggleClass("d-block , flipInX");
    });


