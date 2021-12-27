#!/bin/bash
aws lambda invoke --function-name tasks --output json output.json >>/dev/null ; cat output.json|jq -r| sed 's/\\n/\n/g'; rm output.json
