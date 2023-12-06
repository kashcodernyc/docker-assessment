# Containerizing WordPress 

THis Wordpress based website/application renders a page that displays a list of all US states and territories. The application also runs in a docker container on the user's host machine.

## Getting Started

These instructions will guide you through cloning the repository and running the project locally using Docker.

### Prerequisites

Make sure you have the following tools installed on your machine:

- Docker
- Git

### Cloning the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/akc-org/assessment-prakash-s.git
cd docker-assessment
```
### Navigate to the theme directory

```bash
cd wp-content/themes/main
```

### Install Dependencies

Run Composer to install the project dependencies:

```bash
composer install
```
### Build and run docker containers

```bash
docker-compose up -d
```
This command will pull the necessary Docker images, create and start the containers.

### Accessing the Wordpress Page that displays the State in USA
Open your web browser and go to http://localhost:8000. You should see a wordpress page.
After that you have to sign up with username password and title. Then after you sign in go to themes and activate the US State and Territories.


### Stopping the Containers

```bash
docker-compose down
```
This will stop and remove the containers.




