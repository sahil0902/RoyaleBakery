document.addEventListener('DOMContentLoaded', (event) => {
  const searchForm = document.getElementById('ajax-search-form');
  const searchInput = document.getElementById('search-query');
  const resultsContainer = document.getElementById('search-results');
  const clearButton = document.getElementById('clear-search');
  const loadingSpinner = document.getElementById('loading');
  
  searchForm.addEventListener('submit', function(e) {
    e.preventDefault();
    resultsContainer.innerHTML = '';
    loadingSpinner.classList.add('show');
    clearButton.style.display = 'none';
    
    var searchQuery = searchInput.value;
  
    fetch('ajax_search_handler.php', {
      method: 'POST',
      body: JSON.stringify({ 
        query: searchQuery,
        searchIn: ['name', 'category']
      }),
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      loadingSpinner.classList.remove('show');

      if (!data.html || data.html.trim() === '') {
        showNotification('Unable to find any menu items matching your search.');
        resultsContainer.innerHTML = '<p>No results found.</p>';
      } else {
        resultsContainer.innerHTML = data.html;
        if (searchQuery) {
          clearButton.style.display = 'inline-block';
        }
        showNotification('Search completed successfully.');
      }
    })
    .catch(error => {
      showNotification('There was an error processing your request. Please try again later.');
      console.error('Error:', error);
      loadingSpinner.classList.remove('show');
    });
  });

  clearButton.addEventListener('click', function() {
    searchInput.value = '';
    resultsContainer.innerHTML = '';
    clearButton.style.display = 'none';
    loadingSpinner.classList.remove('show');
  });
});



  document.getElementById('ajax-search-form').addEventListener('submit', function(e) {
  e.preventDefault();
  // Show the spinner
  document.getElementById('loading').style.display = 'block';
  
  // Simulate an AJAX call with a timeout
  setTimeout(function() {
    // This is where you would normally handle the AJAX response
    document.getElementById('loading').style.display = 'none';
  }, 2000); // Simulate a 2 second delay
});
