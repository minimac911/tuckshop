
/* myFunction toggles between adding and removing the show class, which is used to hide and show the dropdown content */
function showDrop() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.addEventListener("click", function(event) {
    if (!event.target.matches('.dropbtn')) {
        document.getElementById("myDropdown").classList.remove("show");
    }
});
