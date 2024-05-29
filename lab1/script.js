document.addEventListener('DOMContentLoaded', () => {
    fetchPosts();
});

function fetchPosts() {
    const postsContainer = document.getElementById('posts-container');
    const apiURL = 'https://api.example.com/posts'; // Replace with your actual API URL

    fetch(apiURL)
        .then(response => response.json())
        .then(data => {
            data.posts.forEach(post => {
                const postElement = document.createElement('div');
                postElement.className = 'post';
                postElement.innerHTML = `
                    <img src="${post.image}" alt="${post.title}">
                    <div class="post-content">
                        <small>${post.date} | Category</small>
                        <h3>${post.title}</h3>
                        <p>${post.excerpt}</p>
                        <a href="${post.url}">Read More</a>
                    </div>
                `;
                postsContainer.appendChild(postElement);
            });
        })
        .catch(error => console.error('Error fetching posts:', error));
}
