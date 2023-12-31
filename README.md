# Dillinger
## _Symfony 6 Fundamentals Project Installation Guide_

## Prerequisites

Before you begin, make sure you have the following installed on your system:

- PHP (version 7.4 or higher)
- Composer
- Symfony CLI
- MySQL or any other supported database management system

## Step 1: Clone the Project Repository

```bash
git clone https://github.com/your_username/symfony-fundamentals.git
cd symfony-fundamentals
```

## Step 2: Install Dependencies

```bash
composer install
```

## Step 3: Configure Environment Variables

Copy the `.env` file and configure it according to your database credentials:

```bash
cp .env.dist .env
```

Edit the `.env` file to set the database credentials:

```yaml
# .env

DATABASE_URL=mysql://db_user:db_password@localhost:3306/db_name
```

## Step 4: Create the Database

```bash
symfony console doctrine:database:create
```

## Step 5: Run Migrations

```bash
symfony console doctrine:migrations:migrate
```

## Step 6: Load Fixtures (Optional)

If you want to populate the database with sample data:

```bash
symfony console doctrine:fixtures:load
```

## Step 7: Start the Symfony Server

```bash
symfony server:start
```

You should now be able to access your Symfony 6 Fundamentals project at `http://127.0.0.1:8000`.

## Additional Commands

- To stop the Symfony server:

```bash
symfony server:stop
```

- To clear the cache:

```bash
symfony console cache:clear
```

- To update the database schema after making changes to your entities:

```bash
symfony console doctrine:schema:update --force
```

Congratulations! Your Symfony 6 Fundamentals project is now installed and ready to use. Happy coding!
```
