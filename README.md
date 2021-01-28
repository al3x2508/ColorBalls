# Grouping balls into maximum 2 colors

We created a controller (`app/Http/Controllers/BallsController.php`) for solving the groups and returning a JSON response
We added a route (`routes/api.php`) that will call the BallsController when there is a POST to the `/balls` url

Assuming we have an array like `[A = 4, B = 3, C = 7, D = 2, E = 9]`

* **Step 1:**
We will try first to get the sets of balls that can provide exactly the number of the group (in our case, _n_ = 5)
* _B_ + _D_ first group (3 + 2 = 5)

* **Step 2:**
Then we will check what colors we can combine, so we can create a new group of n balls, even the combination leaves some rest from the second color
* _A_ + _C_ (4 + 7 = 11; Remaining _C_ balls = 6)

* **Step 3:** 
We will add the remaining balls based on a color that can create themselves one group

Then we will repeat the algorithm from **Step 1** for the remaining balls
