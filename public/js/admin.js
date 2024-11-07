

function toggleArrow(sectionId) {
    console.log(`Toggling arrow for section: ${sectionId}`);
    const arrow = document.getElementById(`arrow-${sectionId}`);
    if (arrow) {
        arrow.classList.toggle('rotate');
    }
}




