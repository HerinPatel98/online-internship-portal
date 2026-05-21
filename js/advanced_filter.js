// Advanced Filter Functionality

class AdvancedFilter {
    constructor() {
        this.filters = {};
        this.searchQuery = '';
        this.sortBy = 'recent';
        this.currentPage = 1;
        this.resultsPerPage = 12;
        this.init();
    }

    init() {
        this.attachEventListeners();
        this.loadFiltersFromURL();
    }

    attachEventListeners() {
        // Search
        const searchBtn = document.querySelector('.search-box button');
        const searchInput = document.querySelector('.search-box input');
        
        if (searchBtn) {
            searchBtn.addEventListener('click', () => this.handleSearch());
        }
        if (searchInput) {
            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') this.handleSearch();
            });
        }

        // Checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', () => this.handleCheckboxChange());
        });

        // Radio buttons
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', () => this.handleRadioChange());
        });

        // Range sliders
        document.querySelectorAll('.slider').forEach(slider => {
            slider.addEventListener('input', () => this.handleRangeChange());
        });

        // Select dropdowns
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', () => this.handleSelectChange());
        });

        // Sort
        const sortSelect = document.querySelector('.sort-select');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                this.sortBy = e.target.value;
                this.applyFilters();
            });
        }

        // Clear filters
        const clearBtn = document.querySelector('.clear-filters');
        if (clearBtn) {
            clearBtn.addEventListener('click', () => this.clearAllFilters());
        }

        // Pagination
        document.querySelectorAll('.pagination button').forEach(btn => {
            btn.addEventListener('click', (e) => {
                this.currentPage = parseInt(e.target.dataset.page);
                this.applyFilters();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    }

    handleSearch() {
        const searchInput = document.querySelector('.search-box input');
        this.searchQuery = searchInput.value.trim();
        this.currentPage = 1;
        this.applyFilters();
    }

    handleCheckboxChange() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        const filterType = event.target.name;
        
        this.filters[filterType] = Array.from(checkboxes)
            .filter(cb => cb.name === filterType)
            .map(cb => cb.value);
        
        this.currentPage = 1;
        this.applyFilters();
    }

    handleRadioChange() {
        const selectedRadio = event.target;
        this.filters[selectedRadio.name] = selectedRadio.value;
        this.currentPage = 1;
        this.applyFilters();
    }

    handleRangeChange() {
        const minInput = event.target.closest('.filter-section').querySelector('input[data-type="min"]');
        const maxInput = event.target.closest('.filter-section').querySelector('input[data-type="max"]');
        
        if (minInput && maxInput) {
            const rangeType = event.target.closest('.filter-section').dataset.filter;
            this.filters[rangeType] = {
                min: parseInt(minInput.value),
                max: parseInt(maxInput.value)
            };
        }
        
        this.currentPage = 1;
        this.applyFilters();
    }

    handleSelectChange() {
        const select = event.target;
        const filterType = select.dataset.filter;
        this.filters[filterType] = select.value || null;
        
        if (!this.filters[filterType]) {
            delete this.filters[filterType];
        }
        
        this.currentPage = 1;
        this.applyFilters();
    }

    applyFilters() {
        this.updateActiveFiltersDisplay();
        this.filterAndDisplayResults();
        this.updateURL();
    }

    updateActiveFiltersDisplay() {
        const activeFiltersContainer = document.querySelector('.active-filters');
        
        if (!activeFiltersContainer) return;
        
        activeFiltersContainer.innerHTML = '';

        Object.keys(this.filters).forEach(key => {
            const value = this.filters[key];
            
            if (Array.isArray(value)) {
                value.forEach(v => {
                    this.addFilterTag(key, v);
                });
            } else if (typeof value === 'object' && value !== null) {
                this.addFilterTag(key, `${value.min} - ${value.max}`);
            } else {
                this.addFilterTag(key, value);
            }
        });
    }

    addFilterTag(filterType, value) {
        const activeFiltersContainer = document.querySelector('.active-filters');
        const tag = document.createElement('div');
        tag.className = 'filter-tag';
        tag.innerHTML = `
            <span>${filterType}: ${value}</span>
            <button type="button" onclick="advancedFilter.removeFilter('${filterType}', '${value}')">×</button>
        `;
        activeFiltersContainer.appendChild(tag);
    }

    removeFilter(filterType, value) {
        if (Array.isArray(this.filters[filterType])) {
            this.filters[filterType] = this.filters[filterType].filter(v => v !== value);
            if (this.filters[filterType].length === 0) {
                delete this.filters[filterType];
            }
        } else {
            delete this.filters[filterType];
        }
        
        this.currentPage = 1;
        this.applyFilters();
    }

    clearAllFilters() {
        this.filters = {};
        this.searchQuery = '';
        this.currentPage = 1;
        
        // Reset all inputs
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);
        document.querySelector('.search-box input').value = '';
        
        this.applyFilters();
    }

    filterAndDisplayResults() {
        const cards = document.querySelectorAll('.results-grid .card');
        let visibleCount = 0;

        cards.forEach(card => {
            const matches = this.matchesFilters(card);
            card.style.display = matches ? 'block' : 'none';
            if (matches) visibleCount++;
        });

        // Update results count
        const resultsCount = document.querySelector('.results-count');
        if (resultsCount) {
            resultsCount.textContent = `Showing ${visibleCount} results`;
        }

        // Show/hide no results message
        if (visibleCount === 0) {
            if (!document.querySelector('.no-results')) {
                const noResults = document.createElement('div');
                noResults.className = 'no-results';
                noResults.innerHTML = `
                    <h3>No results found</h3>
                    <p>Try adjusting your filters or search criteria</p>
                `;
                document.querySelector('.results-grid').appendChild(noResults);
            }
        } else {
            const noResults = document.querySelector('.no-results');
            if (noResults) noResults.remove();
        }
    }

    matchesFilters(card) {
        // Search query match
        if (this.searchQuery) {
            const cardText = card.textContent.toLowerCase();
            if (!cardText.includes(this.searchQuery.toLowerCase())) {
                return false;
            }
        }

        // Filter matching
        for (const [filterType, filterValue] of Object.entries(this.filters)) {
            const cardFilter = card.dataset[filterType];
            
            if (Array.isArray(filterValue)) {
                if (!filterValue.includes(cardFilter)) {
                    return false;
                }
            } else if (typeof filterValue === 'object' && filterValue !== null) {
                const cardValue = parseInt(cardFilter);
                if (cardValue < filterValue.min || cardValue > filterValue.max) {
                    return false;
                }
            } else {
                if (cardFilter !== filterValue) {
                    return false;
                }
            }
        }

        return true;
    }

    updateURL() {
        const params = new URLSearchParams();
        
        Object.keys(this.filters).forEach(key => {
            const value = this.filters[key];
            if (Array.isArray(value)) {
                params.set(key, value.join(','));
            } else if (typeof value === 'object' && value !== null) {
                params.set(key, JSON.stringify(value));
            } else {
                params.set(key, value);
            }
        });

        if (this.searchQuery) {
            params.set('search', this.searchQuery);
        }

        params.set('page', this.currentPage);

        const newURL = `${window.location.pathname}?${params.toString()}`;
        window.history.replaceState({}, '', newURL);
    }

    loadFiltersFromURL() {
        const params = new URLSearchParams(window.location.search);
        
        params.forEach((value, key) => {
            if (key === 'search') {
                this.searchQuery = value;
                document.querySelector('.search-box input').value = value;
            } else if (key === 'page') {
                this.currentPage = parseInt(value);
            } else {
                try {
                    this.filters[key] = JSON.parse(value);
                } catch {
                    this.filters[key] = value.includes(',') ? value.split(',') : value;
                }
            }
        });

        this.applyFilters();
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    window.advancedFilter = new AdvancedFilter();
});