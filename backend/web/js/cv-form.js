// ================= FAIL-SAFE INIT =================
window.cvCounters = window.cvCounters || {
    education: 0,
    experience: 0,
    skill: 0,
    social: 0,
    projects: 0,
    achievements: 0,
    languages: 0,
    awards: 0,
    courses: 0
};


// ================= SAFE COUNTER INIT =================
window.cvCounters = window.cvCounters || {};

let educationCounter   = window.cvCounters.education   ?? 0;
let experienceCounter  = window.cvCounters.experience  ?? 0;
let skillCounter       = window.cvCounters.skill       ?? 0;
let socialCounter      = window.cvCounters.social      ?? 0;
let projectCounter     = window.cvCounters.projects    ?? 0;
let achievementCounter = window.cvCounters.achievements ?? 0;
let languageCounter    = window.cvCounters.languages   ?? 0;
let awardCounter       = window.cvCounters.awards      ?? 0;
let courseCounter      = window.cvCounters.courses     ?? 0;


// Track active tab in URL
document.addEventListener('DOMContentLoaded', function () {
    // Function to activate a tab by name
    function activateTab(tabName) {
        const tabButton = document.querySelector(`button[data-tab-name="${tabName}"]`);
        if (tabButton) {
            bootstrap.Tab.getInstance(tabButton)?.show() || new bootstrap.Tab(tabButton).show();
        }
    }

    // Handle tab shown event
    const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (e) {
            const tabName = e.target.getAttribute('data-tab-name');
            const url = new URL(window.location);
            url.searchParams.set('tab', tabName);
            // Use replaceState instead of pushState to avoid cluttering browser history
            window.history.replaceState({}, '', url);
        });
    });

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(event) {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'personal';
        activateTab(activeTab);
    });

    // On initial load, activate the correct tab based on URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const initialTab = urlParams.get('tab') || 'personal';
    activateTab(initialTab);
});

// ================= EDUCATION =================
function addMoreEducation() {
    const container = document.getElementById('education-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'border rounded p-3 mb-3 education-entry';

    newEntry.innerHTML = `
        <input type="hidden" name="Education[${educationCounter}][id]" value="">
        <div class="row">
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Education[${educationCounter}][degree]"
                    placeholder="e.g., Bachelor of Computer Science">
            </div>
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Education[${educationCounter}][institute]"
                    placeholder="e.g., Gujarat University">
            </div>
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Education[${educationCounter}][year]"
                    placeholder="e.g., 2019 - 2023">
            </div>
        </div>
        <div class="mt-2 text-end">
            <button type="button"
                class="btn btn-sm btn-outline-danger"
                onclick="removeEducation(this)">Remove</button>
        </div>
    `;

    container.appendChild(newEntry);
    educationCounter++;
}

function removeEducation(btn) {
    const container = document.getElementById('education-container');
    const entry = btn.closest('.education-entry');
    const idInput = entry.querySelector('input[name*="[id]"]');

    if (idInput && idInput.value !== '') {
        // Existing record - mark for deletion
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = idInput.name.replace('[id]', '[delete]');
        deleteInput.value = '1';
        entry.appendChild(deleteInput);

        // Hide the entry instead of removing it
        entry.style.display = 'none';
    } else {
        // New record - can be safely removed
        if (container.querySelectorAll('.education-entry:not([style*="display: none"])').length > 1) {
            entry.remove();
        } else {
            alert('At least one education entry is required.');
        }
    }
}

// ================= EXPERIENCE =================
function addMoreExperience() {
    const container = document.getElementById('experience-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'border rounded p-3 mb-3 experience-entry';

    newEntry.innerHTML = `
        <input type="hidden" name="Experience[${experienceCounter}][id]" value="">
        <div class="row">
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Experience[${experienceCounter}][company]"
                    placeholder="e.g., Tech Solutions Inc.">
            </div>
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Experience[${experienceCounter}][position]"
                    placeholder="e.g., Senior Developer">
            </div>
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Experience[${experienceCounter}][duration]"
                    placeholder="e.g., Jan 2020 - Present">
            </div>
            <div class="col-md-12">
                <textarea class="form-control form-control-sm"
                    name="Experience[${experienceCounter}][description]"
                    rows="2"
                    placeholder="Describe your responsibilities..."></textarea>
            </div>
        </div>
        <div class="mt-2 text-end">
            <button type="button"
                class="btn btn-sm btn-outline-danger"
                onclick="removeExperience(this)">Remove</button>
        </div>
    `;

    container.appendChild(newEntry);
    experienceCounter++;
}

function removeExperience(btn) {
    const container = document.getElementById('experience-container');
    const entry = btn.closest('.experience-entry');
    const idInput = entry.querySelector('input[name*="[id]"]');

    if (idInput && idInput.value !== '') {
        // Existing record - mark for deletion
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = idInput.name.replace('[id]', '[delete]');
        deleteInput.value = '1';
        entry.appendChild(deleteInput);

        // Hide the entry instead of removing it
        entry.style.display = 'none';
    } else {
        // New record - can be safely removed
        if (container.querySelectorAll('.experience-entry:not([style*="display: none"])').length > 1) {
            entry.remove();
        } else {
            alert('At least one experience entry is required.');
        }
    }
}

// ================= SKILLS =================
function addMoreSkill() {
    const container = document.getElementById('skills-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'col-md-3 mb-2 skill-entry';

    newEntry.innerHTML = `
        <input type="hidden" name="Skill[${skillCounter}][id]" value="">
        <div class="position-relative">
            <input type="text" class="form-control form-control-sm"
                name="Skill[${skillCounter}][name]"
                placeholder="e.g., PHP, JavaScript">
            <button type="button"
                class="btn btn-sm btn-outline-danger position-absolute top-0 end-0"
                style="transform: translate(50%, -50%);"
                onclick="removeSkill(this)">×</button>
        </div>
    `;

    container.appendChild(newEntry);
    skillCounter++;
}

function removeSkill(btn) {
    const container = document.getElementById('skills-container');
    const entry = btn.closest('.skill-entry');
    const idInput = entry.querySelector('input[name*="[id]"]');

    if (idInput && idInput.value !== '') {
        // Existing record - mark for deletion
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = idInput.name.replace('[id]', '[delete]');
        deleteInput.value = '1';
        entry.appendChild(deleteInput);

        // Hide the entry instead of removing it
        entry.style.display = 'none';
    } else {
        // New record - can be safely removed
        if (container.querySelectorAll('.skill-entry:not([style*="display: none"])').length > 1) {
            entry.remove();
        } else {
            alert('At least one skill is required.');
        }
    }
}

// ================= SOCIAL =================
function addMoreSocial() {
    const container = document.getElementById('social-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'border rounded p-3 mb-3 social-entry';

    newEntry.innerHTML = `
        <input type="hidden" name="Social[${socialCounter}][id]" value="">
        <div class="row">
            <div class="col-md-6 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Social[${socialCounter}][platform]"
                    placeholder="e.g., LinkedIn">
            </div>
            <div class="col-md-6 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Social[${socialCounter}][url]"
                    placeholder="https://linkedin.com/in/you">
            </div>
        </div>
        <div class="mt-2 text-end">
            <button type="button"
                class="btn btn-sm btn-outline-danger"
                onclick="removeSocial(this)">Remove</button>
        </div>
    `;

    container.appendChild(newEntry);
    socialCounter++;
}

function removeSocial(btn) {
    const container = document.getElementById('social-container');
    const entry = btn.closest('.social-entry');
    const idInput = entry.querySelector('input[name*="[id]"]');

    if (idInput && idInput.value !== '') {
        // Existing record - mark for deletion
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = idInput.name.replace('[id]', '[delete]');
        deleteInput.value = '1';
        entry.appendChild(deleteInput);

        // Hide the entry instead of removing it
        entry.style.display = 'none';
    } else {
        // New record - can be safely removed
        if (container.querySelectorAll('.social-entry:not([style*="display: none"])').length > 1) {
            entry.remove();
        } else {
            alert('At least one social link is required.');
        }
    }
}

// ================= PROJECTS =================
function addMoreProject() {
    const container = document.getElementById('projects-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'border rounded p-3 mb-3';

    newEntry.innerHTML = `
        <input type="hidden" name="Project[${projectCounter}][id]" value="">
        <div class="row">
            <div class="col-md-12 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Project[${projectCounter}][title]"
                    placeholder="Project Title">
            </div>
            <div class="col-md-12 mb-2">
                <textarea class="form-control form-control-sm"
                    name="Project[${projectCounter}][description]"
                    rows="2"
                    placeholder="Project Description"></textarea>
            </div>
            <div class="col-md-12">
                <input type="text" class="form-control form-control-sm"
                    name="Project[${projectCounter}][tech_stack]"
                    placeholder="Tech Stack (Laravel, MySQL...)">
            </div>
        </div>
        <div class="mt-2 text-end">
            <button type="button"
                class="btn btn-sm btn-outline-danger"
                onclick="removeProject(this)">Remove</button>
        </div>
    `;

    container.appendChild(newEntry);
    projectCounter++;
}

function removeProject(btn) {
    const container = document.getElementById('projects-container');
    const entry = btn.closest('.border.rounded.p-3.mb-3');
    const idInput = entry.querySelector('input[name*="[id]"]');

    if (idInput && idInput.value !== '') {
        // Existing record - mark for deletion
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = idInput.name.replace('[id]', '[delete]');
        deleteInput.value = '1';
        entry.appendChild(deleteInput);

        // Hide the entry instead of removing it
        entry.style.display = 'none';
    } else {
        // New record - can be safely removed
        if (container.querySelectorAll('.border.rounded.p-3.mb-3:not(.education-entry):not(.experience-entry):not(.social-entry):not([style*="display: none"])').length > 1) {
            entry.remove();
        } else {
            alert('At least one project is required.');
        }
    }
}

// ================= ACHIEVEMENTS =================
function addMoreAchievement() {
    const container = document.getElementById('achievements-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'border rounded p-3 mb-3';

    newEntry.innerHTML = `
        <input type="hidden" name="Achievement[${achievementCounter}][id]" value="">
        <div class="row">
            <div class="col-md-12 mb-2">
                <input type="text" class="form-control form-control-sm"
                    name="Achievement[${achievementCounter}][title]"
                    placeholder="Achievement Title">
            </div>
            <div class="col-md-12">
                <textarea class="form-control form-control-sm"
                    name="Achievement[${achievementCounter}][description]"
                    rows="2"
                    placeholder="Description"></textarea>
            </div>
        </div>
        <div class="mt-2 text-end">
            <button type="button"
                class="btn btn-sm btn-outline-danger"
                onclick="removeAchievement(this)">Remove</button>
        </div>
    `;

    container.appendChild(newEntry);
    achievementCounter++;
}

function removeAchievement(btn) {
    const container = document.getElementById('achievements-container');
    const entry = btn.closest('.border.rounded.p-3.mb-3');
    const idInput = entry.querySelector('input[name*="[id]"]');

    if (idInput && idInput.value !== '') {
        // Existing record - mark for deletion
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = idInput.name.replace('[id]', '[delete]');
        deleteInput.value = '1';
        entry.appendChild(deleteInput);

        // Hide the entry instead of removing it
        entry.style.display = 'none';
    } else {
        // New record - can be safely removed
        if (container.querySelectorAll('.border.rounded.p-3.mb-3:not(.education-entry):not(.experience-entry):not(.social-entry):not(.skill-entry):not([style*="display: none"])').length > 1) {
            entry.remove();
        } else {
            alert('At least one achievement is required.');
        }
    }
}

// ================= LANGUAGES =================
function addMoreLanguage() {
    const container = document.getElementById('languages-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'skill-item d-flex gap-2 position-relative';

    newEntry.innerHTML = `
        <input type="hidden" name="Language[${languageCounter}][id]" value="">
        <input type="text" class="form-control"
            name="Language[${languageCounter}][name]"
            placeholder="Language (e.g. English)">
        <select class="form-control" name="Language[${languageCounter}][proficiency]">
            <option value="">Proficiency</option>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Fluent">Fluent</option>
            <option value="Native">Native</option>
        </select>
        <button type="button"
            class="btn btn-sm btn-outline-danger"
            onclick="removeLanguage(this)">×</button>
    `;

    container.appendChild(newEntry);
    languageCounter++;
}

function removeLanguage(btn) {
    const container = document.getElementById('languages-container');
    const entry = btn.closest('.skill-item.d-flex.gap-2.position-relative');
    const idInput = entry.querySelector('input[name*="[id]"]');

    if (idInput && idInput.value !== '') {
        // Existing record - mark for deletion
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = idInput.name.replace('[id]', '[delete]');
        deleteInput.value = '1';
        entry.appendChild(deleteInput);

        // Hide the entry instead of removing it
        entry.style.display = 'none';
    } else {
        // New record - can be safely removed
        if (container.querySelectorAll('.skill-item.d-flex.gap-2.position-relative:not([style*="display: none"])').length > 1) {
            entry.remove();
        } else {
            alert('At least one language is required.');
        }
    }
}

// ================= AWARDS =================
function addMoreAward() {
    const container = document.getElementById('awards-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'border rounded p-3 mb-3';

    newEntry.innerHTML = `
        <input type="hidden" name="Award[${awardCounter}][id]" value="">
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control form-control-sm"
                    name="Award[${awardCounter}][title]"
                    placeholder="Award Title">
            </div>
        </div>
        <div class="mt-2 text-end">
            <button type="button"
                class="btn btn-sm btn-outline-danger"
                onclick="removeAward(this)">Remove</button>
        </div>
    `;

    container.appendChild(newEntry);
    awardCounter++;
}

function removeAward(btn) {
    const container = document.getElementById('awards-container');
    const entry = btn.closest('.border.rounded.p-3.mb-3');
    const idInput = entry.querySelector('input[name*="[id]"]');

    if (idInput && idInput.value !== '') {
        // Existing record - mark for deletion
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = idInput.name.replace('[id]', '[delete]');
        deleteInput.value = '1';
        entry.appendChild(deleteInput);

        // Hide the entry instead of removing it
        entry.style.display = 'none';
    } else {
        // New record - can be safely removed
        if (container.querySelectorAll('.border.rounded.p-3.mb-3:not(.education-entry):not(.experience-entry):not(.social-entry):not(.skill-entry):not([style*="display: none"])').length > 1) {
            entry.remove();
        } else {
            alert('At least one award is required.');
        }
    }
}

// ================= COURSES =================
function addMoreCourse() {
    const container = document.getElementById('courses-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'border rounded p-3 mb-3';

    newEntry.innerHTML = `
        <input type="hidden" name="Course[${courseCounter}][id]" value="">
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control form-control-sm"
                    name="Course[${courseCounter}][title]"
                    placeholder="Course Name">
            </div>
        </div>
        <div class="mt-2 text-end">
            <button type="button"
                class="btn btn-sm btn-outline-danger"
                onclick="removeCourse(this)">Remove</button>
        </div>
    `;

    container.appendChild(newEntry);
    courseCounter++;
}

function removeCourse(btn) {
    const container = document.getElementById('courses-container');
    const entry = btn.closest('.border.rounded.p-3.mb-3');
    const idInput = entry.querySelector('input[name*="[id]"]');

    if (idInput && idInput.value !== '') {
        // Existing record - mark for deletion
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = idInput.name.replace('[id]', '[delete]');
        deleteInput.value = '1';
        entry.appendChild(deleteInput);

        // Hide the entry instead of removing it
        entry.style.display = 'none';
    } else {
        // New record - can be safely removed
        if (container.querySelectorAll('.border.rounded.p-3.mb-3:not(.education-entry):not(.experience-entry):not(.social-entry):not(.skill-entry):not([style*="display: none"])').length > 1) {
            entry.remove();
        } else {
            alert('At least one course is required.');
        }
    }
}
