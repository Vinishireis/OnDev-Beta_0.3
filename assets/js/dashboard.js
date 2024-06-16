const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})

document.addEventListener('DOMContentLoaded', () => {
    const createSkillButton = document.getElementById('createSkillButton');
    const skillForm = document.getElementById('skillForm');
    const skillInput = document.getElementById('skillInput');
    const saveSkillButton = document.getElementById('saveSkillButton');
    const cancelSkillButton = document.getElementById('cancelSkillButton');
    const skillsList = document.getElementById('skillsList');

    let skillCount = 0;

    createSkillButton.addEventListener('click', () => {
        skillForm.classList.remove('hidden');
        skillInput.focus();
    });

    saveSkillButton.addEventListener('click', () => {
        const skillText = skillInput.value.trim();
        if (skillText !== '') {
            skillCount++;
            const listItem = document.createElement('li');
            listItem.textContent = `${skillText}`;
            skillsList.appendChild(listItem);
            skillInput.value = '';
            skillForm.classList.add('hidden');
        }
    });

    cancelSkillButton.addEventListener('click', () => {
        skillInput.value = '';
        skillForm.classList.add('hidden');
    });
});

$(document).ready(function() {
	$("#search-bar").on("input", function() {
	  var searchTerm = $(this).val().toLowerCase();
  
	  // Filter the user data based on the search term
	  var filteredData = [];
	  for (var i = 0; i < users.length; i++) {
		var user = users[i];
		var fullName = user.firstName + " " + user.lastName;
		if (fullName.toLowerCase().indexOf(searchTerm) !== -1) {
		  filteredData.push(user);
		}
	  }
  
	  // Update the user list based on the filtered data
	  $("#user-list").empty();
	  for (var i = 0; i < filteredData.length; i++) {
		var user = filteredData[i];
		var userHTML = "<li>" + user.firstName + " " + user.lastName + "</li>";
		$("#user-list").append(userHTML);
	  }
	});
  });
  