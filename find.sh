#!/bin/bash
grep -H -r "$1" './export' | cut -d: -f1
