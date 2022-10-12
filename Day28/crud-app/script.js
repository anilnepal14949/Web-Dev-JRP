const JSONURL = 'https://jsonplaceholder.typicode.com/posts/';

const postsForm = document.querySelector('#postsForm');
const postsTableBody = document.querySelector('#postsTable tbody');
const title = document.querySelector('#title');
const body = document.querySelector('#body');
const createBtn = document.querySelector('#createBtn');

fetchPosts();
async function fetchPosts() {
	const resp = await fetch(JSONURL);
	const respData = await resp.json();

	posts = respData.slice(15, 20);
	
	posts.map(post => {
		console.log(post);
		postsTableBody.innerHTML += `
			<tr>
				<td> ${post.id} </td>
				<td> ${post.title} </td>
				<td> ${post.body} </td>
				<td><button id="editBtn"> Edit </button><button id="deleteBtn"> Delete </button></td>
			</tr>
		`;
	});
}

async function createPost() {
	const resp = await fetch(JSONURL, {
	  	method: 'POST',
	  	body: JSON.stringify({
	    	title: title.value,
	    	body: body.value,
	    	userId: 6,
	  	}),
	  	headers: {
	    	'Content-type': 'application/json; charset=UTF-8',
	  	},
	});
	const respData = await resp.json();
	const post = respData;
	postsForm.reset();
	postsTableBody.innerHTML += `
		<tr>
			<td> ${post.id} </td>
			<td> ${post.title} </td>
			<td> ${post.body} </td>
			<td><button id="editBtn"> Edit </button><button id="deleteBtn"> Delete </button></td>
		</tr>
	`;
}

createBtn.addEventListener("click", (e) => { 
	e.preventDefault();
	createPost();
});