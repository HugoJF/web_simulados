# Web simulados


# Controllers

## Accounts controller

### /accounts/index/
#### Redirects to /accounts/login/

---

### /accounts/login/
#### Controls the login authentication.
* **$_POST**
  * *logging_in* - Empty POST variable to check if there's a login going on
  * *email* - The user's email 
  * *password* - The user's password
  * *remember* - If login should be remembered

---

### /accounts/logout/
#### Controls the logout
* **$_POST**
  * No POST required/available

---
---

## Ajax controller

### /ajax/get_categories/
#### Returns JSON with entire *category* database
* **$_POST**
  * No POST required/available

---
---

## Questions controller

### /questions/index/
#### Yet to be developed, currently showing *type* 0 *categories*
* **$_POST**
  * No POST required/available

---

### /questions/bycategory/*$categoryId*
#### Yet to be developed, currently all question from category *$categoryId*
* **$_POST**
  * No POST required/available

---

### /questions/id/*$id*
#### Shows question with id *$id*
* **$_POST**
  * No POST required/available

---

### /questions/answer/
#### Show question with id *$id* with answer
* **$_POST**
  * *answer* - Choosen answer for the question

---

### /questions/categories/
#### Shows interface to choose what categories user want
* **$_POST**
  * No POST required/available

---

### /questions/search/*$categories*/*$perCategory*/
#### Shows *$perCategory* questions from categories *$categories*
* **$_POST**
  * No POST required/available

---

### /questions/view/
#### Show multiple questions in one page, id's returned from func_get_args();
* **$_POST**
  * No POST required/available

---

### /questions/view_answer/
#### Show multiple questions in one page with answer highlighted, id's return from func_get_args();
* **$_POST**
  * No POST required/available
