#!/bin/bash
echo " " >> README.md
git add .satori.yml push_commit.sh README.md run*.sh
git commit -a -m "test"
git push
sleep 10
./run-tasks.sh 
