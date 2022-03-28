FROM gitpod/workspace-mysql

RUN sudo apt-get update && apt-get install php-xdebug -y