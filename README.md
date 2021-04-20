# How to use in Local computer (Steps):
  1. If Laravel is not yet installed, follow this tutorial to install: https://laravel.com/docs/4.2#install-composer
  2. Clone the repository to a directory of your choice
  ```shell 
    git clone https://github.com/nafuza1299/CSCI334-Project.git 
   ```
  3. Edit the .env file inside the "website" folder
  -- Replace {{IP_ADDR}} to http:/localhost
  4. Open Terminal and change current directory to website folder
  ```shell
  cd [your local path]/CSCI334-Project/website/
  ```
  5. Once the current directory is .../CSCI334-Project/website/ 
  ```shell
    php artisan serve
  ```
# How to Push (Steps):
  **DO NOT PUSH the .env file** that is inside the website folder
 1. Create a new branch
```shell
git checkout -b <new-branch-name>
```
Example
```shell
git checkout -b mybranch
```
2. Create a update code on the branch
3. Git add, commit, and push

```shell
git add <directory to add>
git commit -m "<message>"
git push -u origin <new-branch-name>:<new-branch-name>
```

4. Create a pull request to master
5. Add a reviewe, and assigne
6. Wait for Review
7. Merge Pull Request

# How to deploy to server
1. Clone Repository
```shell 
git clone https://github.com/nafuza1299/CSCI334-Project.git 
```
2. Change directory to cloned repository
```shell 
cd CSCI334-Project
```
3. Change Script permission
```shell 
chmod +x /CSCI334-Project/start.sh
```
4. Run the script
```shell 
./start.sh
```

