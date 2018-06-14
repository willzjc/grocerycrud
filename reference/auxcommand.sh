#!/bin/bash
dset ()
{
    unset DOCKER_HOST;
    export DOCKER_HOST="$1:2375";
    checktls $1
}

dunset ()
{
    unset DOCKER_HOST;
    export DOCKER_HOST="localhost:2375";
    checktls `hostname`
}


checktls ()
{
    currenthost=`hostname`;
    currenthost=${currenthost//".tibra.com"};
    checkhost="${1//".tibra.com"}";
    if [[ ! -z $(grep $checkhost /usr/share/docker/tlshosts) ]]; then
        export DOCKER_TLS_VERIFY=1;
        if [ "$(id -u)" == "0" ]; then
            export DOCKER_CERT_PATH=/etc/docker/ssl;
        else
            export DOCKER_CERT_PATH=$HOME/.docker;
        fi;
    else
        unset DOCKER_TLS_VERIFY;
        unset DOCKER_CERT_PATH;
    fi
}
#

rm *.proclog
rm *.log

server_cfg="/usr/share/docker/tlshosts"
server_cfg="docker_servers"
while read server; do
  echo "Scanning: ${server}"
  dset $server
  docker ps --format '{{.ID}}\t{{.Names}}\t{{.Image}}\t{{.Command}}\t{{.Status}}\t{{.Ports}}\t{{.RunningFor}}' > docker_proccesses_${server}.proclog &
#  sleep 1
done < $server_cfg
