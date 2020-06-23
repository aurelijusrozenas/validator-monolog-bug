# Case with strange bug with monolog and validation
There is `MyEntity` with `UniqueEntity` constraint set for `uniqueField`. One entity is created and stored in DB, the new one created and 
`ValidatorInterface->validate()` is called.  
It should return validation error for `UniqueEntity` constraint but it does not. Why? Because there is monolog
handler `MyHandler` registered and it has `ValidatorInterface` injected.  
That's it. Handler does not do anything by it self. Removing handler registration from 
`config/packages/monolog.yaml` or removing `ValidatorInterface` injection from `MyHandler` fixes the problem and validator works as expected.  
This project is setup with sqlite but the same problem happens with mysql.

# Setup project
```bash
git clone git@github.com:aurelijusrozenas/validator-monolog-bug.git
cd validator-monolog-bug
composer install
bin/console doctrine:migrations:migrate -n
```

# Run command to see the problem
```bash
bin/console app
```
You should see either `Validation failed because it did not detect failing constraint.` or `Everything is working correctly.`. To change behaviour change
`config/packages/monolog.yaml` or `src/Monolog/MyHandler.php` (search for `FIXME`).
