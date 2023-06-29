#!/bin/bash

res=$(docker logs d0c9d16e37da 2>/dev/null | sed -n "s/\(.*\)\(GENERATED ROOT PASSWORD: \)\(.*\)/\3/p") 
echo "$res"
