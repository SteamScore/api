#!/usr/bin/env bash
set -x
pip install ansible
openssl aes-256-cbc -K $encrypted_a837f529038e_key -iv $encrypted_a837f529038e_iv -in ./.travis/id_ed25519.enc -out ./.travis/id_ed25519 -d
eval "$(ssh-agent -s)"
chmod 600 ./.travis/id_ed25519
ssh-add ./.travis/id_ed25519
