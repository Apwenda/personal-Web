document.addEventListener("DOMContentLoaded", function () {
  fetch("data.json")
    .then(response => {
      if (!response.ok) {
        throw new Error("Gagal mengambil data JSON");
      }
      return response.json();
    })
    .then(data => {
      displayBooks(data.books);
      displayArticles(data.articles);
    })
    .catch(error => {
      console.error("Terjadi kesalahan:", error);
    });

  function displayBooks(books) {
    const container = document.getElementById("book-container");
    if (!container) return;

    if (!Array.isArray(books)) {
      console.warn("Data buku tidak valid.");
      return;
    }

    container.innerHTML = books
      .map(book => `
        <div class="book">
          <img src="${book.cover}" alt="${book.title}" class="book-cover">
          <h3 class="book-title">${book.title}</h3>
          <p class="book-author">${book.author}</p>
          <p class="book-description">${book.description}</p>
        </div>
      `)
      .join("");
  }

  function displayArticles(articles) {
    const container = document.getElementById("article-container");
    if (!container) return;

    if (!Array.isArray(articles)) {
      console.warn("Data artikel tidak valid.");
      return;
    }

    container.innerHTML = articles
      .map(article => `
        <div class="article">
          <h3 class="article-title">${article.title}</h3>
          <p class="article-author">${article.author}</p>
          <p class="article-date">${article.date}</p>
          <p class="article-content">${article.content}</p>
        </div>
      `)
      .join("");
  }
});
