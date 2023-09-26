const listTodo = document.querySelector(".list-todo");

async function fetchTodo(url) {
  const response = await fetch(url);
  const datas = await response.json();

  datas.map((data, index) => {
    listTodo.innerHTML += `
    <article class="todo" id=${data.id}>
      <h2 class="title title${index}"> ${data.name}</h2>
      <p class="desc desc${index}"> ${data.description}</p>
      <p class="deadline deadline${index}"> ${data.deadline}</p>
      <button class="done button${index}">X</button>
    </article>
      `;
  });

  const todos = document.querySelectorAll(".title");

  todos.forEach((todo, index) => {
    todo.addEventListener("click", () => {
      const title = document.querySelector(`.title${index}`);
      const desc = document.querySelector(`.desc${index}`);
      const deadline = document.querySelector(`.deadline${index}`);
      const isComplete = document.querySelector(`.incomplete${index}`);

      const inputElemenTitle = document.createElement("input");
      inputElemenTitle.type = "text";
      inputElemenTitle.value = title.textContent;

      const inputElementDesc = document.createElement("input");
      inputElementDesc.type = "text";
      inputElementDesc.value = desc.textContent;

      const inputElementDeadline = document.createElement("input");
      inputElementDeadline.type = "text";
      inputElementDeadline.value = deadline.textContent;

      replaceAndUpdate(title, "name", inputElemenTitle, datas, index);
    });
  });

  const todosDesc = document.querySelectorAll(".desc");
  todosDesc.forEach((todo, index) => {
    todo.addEventListener("click", () => {
      const desc = document.querySelector(`.desc${index}`);
      const deadline = document.querySelector(`.deadline${index}`);

      const inputElementDesc = document.createElement("input");
      inputElementDesc.type = "text";
      inputElementDesc.value = desc.textContent;

      const inputElementDeadline = document.createElement("input");
      inputElementDeadline.type = "text";
      inputElementDeadline.value = deadline.textContent;

      replaceAndUpdate(desc, "description", inputElementDesc, datas, index);
    });
  });

  const todosDeadline = document.querySelectorAll(".deadline");
  todosDeadline.forEach((todo, index) => {
    todo.addEventListener("click", () => {
      const deadline = document.querySelector(`.deadline${index}`);

      const inputElementDeadline = document.createElement("input");
      inputElementDeadline.type = "date";
      inputElementDeadline.value = deadline.textContent;

      replaceAndUpdate(
        deadline,
        "deadline",
        inputElementDeadline,
        datas,
        index
      );
    });
  });

  const done = document.querySelectorAll(".done");

  done.forEach((todo, index) => {
    todo.addEventListener("click", () => {
      const formData = new FormData();
      formData.append("id", datas[index]["id"]);
      formData.append(`completed`, 1);
      update(formData, "./updateTodo.php");
    });
  });
}

fetchTodo(
  "https://fransiskus42.web582.com/dynamic/todo_list_group_project/panel.php"
);

async function update(data, url) {
  const response = await fetch(url, {
    method: "POST",
    body: data,
  });

  const datas = response.json();
  listTodo.innerHTML = "";

  fetchTodo(
    "https://fransiskus42.web582.com/dynamic/todo_list_group_project/panel.php"
  );
}

function replaceAndUpdate(target, key, input, datas, index) {
  target.replaceWith(input);
  input.focus();

  input.addEventListener("blur", function () {
    const updatedTask = input.value;

    const formData = new FormData();
    formData.append("id", datas[index]["id"]);
    formData.append(`${key}`, updatedTask);

    update(formData, "./updateTodo.php");
  });
}
